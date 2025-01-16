<?php
namespace App\Http\Controllers;

use App\Mail\MailForInvoice;
use App\Mail\MailForPaymentLink;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Lead;
use Session;
use App\Models\PaymentToken;
use App\Models\Payment;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('transactions');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */


    // public function processTransaction(Request $request)
    // {
    //     // Initialize an empty array to store emails
    //     $emails = [];

    //     // Step 1: Fetch records where payment_link is 0 and converted_to_order is 0
    //     $leads = Lead::where('payment_link', 0)
    //                  ->where('converted_to_order', 0)
    //                  ->get();

    //     // Step 2 & 3: Send email with payment link and update payment_link to 1
    //     foreach ($leads as $lead) {
    //         $provider = new PayPalClient;
    //      $provider->setApiCredentials(config('paypal'));
    //      $paypalToken = $provider->getAccessToken();
    //      $response = $provider->createOrder([
    //          "intent" => "CAPTURE",
    //          "application_context" => [
    //              "return_url" => route('successTransaction'),
    //              "cancel_url" => route('cancelTransaction'),
    //          ],
    //          "purchase_units" => [
    //              0 => [
    //                  "amount" => [
    //                      "currency_code" => "USD",
    //                      "value" => "1000.00"
    //                  ]


    //              ]
    //          ]
    //      ]);
    //         if (isset($response['id']) && $response['id'] != null) {
    //             foreach ($response['links'] as $links) {
    //                 if ($links['rel'] == 'approve') {
    //                     $paymentLink = $links['href'];

    //                     $mailData = [
    //                         'title' => 'Payment Link For Your Order',
    //                         'body' => 'Payment link: ' . $paymentLink,
    //                     ];

    //                     // Send email
    //                     Mail::to($lead->email)->send(new MailForPaymentLink($mailData));

    //                     // Store email in the array
    //                     $emails[] = $lead->email;

    //                     // Update payment_link to 1
    //                     $lead->payment_link = 1;
    //                     $lead->save();
    //                 }
    //             }
    //         } else {
    //             // Handle the case where something went wrong with creating the PayPal order
    //             return redirect()
    //                 ->route('createTransaction')
    //                 ->with('error', 'Something went wrong while creating the order.');
    //         }
    //     }

    //     // Store the emails array in the session
    //     $request->session()->put('payment_emails', $emails);

    //     // Flash a success message indicating emails have been sent
    //     if (count($emails) > 0) {
    //         $emailMessage = count($emails) > 1 ? 'emails have' : 'email has';
    //         $message = ' been ' . $emailMessage . ' sent to ' . implode(', ', $emails);
    //         $request->session()->flash('email_sent_message', $message);

    //         return redirect()
    //             ->route('createTransaction')
    //             ->with('success', 'Payment link sent successfully.');
    //     } else {
    //         return redirect()
    //             ->route('createTransaction')
    //             ->with('error', 'No payment links were sent.');
    //     }
    // }


    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
// dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {


            // Retrieve the emails array from the session
            // $emails = $request->session()->get('payment_emails');

            // Update converted_to_order to 1 for each corresponding email address
            // foreach ($emails as $email) {
            //     $lead = Lead::where('email', $email)->first();
            //     if ($lead) {
            //         $lead->converted_to_order = 1;
            //         $lead->save();
            //     }
            // }
            $paypalOrderId = $response['id'];

            $matchedRecord = PaymentToken::where('orderid', $paypalOrderId)->first();

            if ($matchedRecord) {
                $lead = $matchedRecord->lead;
                if ($lead) {
                    $lead->converted_to_order = 1;
                    $lead->save();

                    $order = new Order;
                    $order->lead_id = $lead->id;
                    $order->shipping_address = 'Xyz Colony Cityport China';
                    $order->billing_address = 'etc Colony NewPort Antinoi 20130';
                    $order->status = 'in-process';
                    $order->save();

                    $newlyInsertedOrderId = $order->id;


                    $invoice = new Invoice;
                    $invoice->order_id = $newlyInsertedOrderId;
                    $invoice->exporter = 'Exporter xyzcv , sec-22 11088 New Delhi India';
                    $invoice->save();

//after getting successfull payment sending  invoice to their email

if (!$lead->invoice_sent){
                    $viewInvoiceLink = url("viewInvoice/{$lead->id}");
                    $mailData = [
                        'title' => 'Click the Invoice link to check your prescription Here...',
                        'body' => ' click this link !!!' . $viewInvoiceLink,
                    ];
        
                    Mail::to($invoice->order->lead->email)->send(new MailForInvoice($mailData));

$lead->invoice_sent==1;
$lead->save();
                }
            }



            $userEmail = $response['payment_source']['paypal']['email_address'];


            $paymentCaptures = $response['purchase_units'][0]['payments']['captures'];
            foreach ($paymentCaptures as $capture) {
                $captureId = $capture['id'];
                $captureStatus = $capture['status'];
                $captureAmount = $capture['amount']['value'];
                $captureCurrency = $capture['amount']['currency_code'];
            }

            $payment =new Payment;
            $payment->transaction_id=$captureId;
            $payment->currency=$captureCurrency;
            $payment->user_email=$userEmail;
            $payment->amount=$captureAmount;
            $payment->status=$captureStatus;




                // Redirect with success message
                return redirect()
                    ->route('createTransaction')
                    ->with('success', 'Transaction complete.');
            } else {
                // Handle unsuccessful payment
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }

    }



    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}

// paypal login id and password
// sb-43lmlo29553185@business.example.com
// iMalone8#