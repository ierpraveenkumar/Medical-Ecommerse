<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Mail\MailForPaymentLink;
use App\Models\Lead;
use App\Http\Controllers\DomPdfController;
use App\Models\PaymentToken;

class sendLinkPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send payment link via mail who didnt receive yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // \Log::info('processTransaction function started.');


        $leads = Lead::where('payment_link', 0)
            ->where('converted_to_order', 0)
            ->get();

        foreach ($leads as $lead) {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('successTransaction'),
                    "cancel_url" => route('cancelTransaction'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "10.00"
                        ]


                    ]
                ]
            ]);
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        $paymentLink = $links['href'];

                        $mailData = [
                            'title' => 'Payment Link For Your Order',
                            'body' => 'Payment link: ' . $paymentLink,
                        ];

                        // Send email
                        Mail::to($lead->email)->send(new MailForPaymentLink($mailData));

                        $Link = new PaymentToken();
                        $Link->lead_id = $lead->id;
                        $Link->orderid = $response['id'];
                        $Link->save();




                        // Update payment_link to 1
                        $lead->payment_link = 1;
                        $lead->save();
                    }
                }
            }
        }
    }
}
