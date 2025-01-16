<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use PDF;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailForPrescription;
use App\Models\PrescriptionToken;


class DomPdfController extends Controller
{
    public function getInvoice(Request $request)
    {
        $selectedOrderIds = explode(',', $request->input('ids'));


        if ($request->ids) {
            $leads = [];

            foreach ($selectedOrderIds as $key => $value) {
                $order = Order::find($value);
                $leads[] = Lead::with('order')->where('id', $order->lead_id)->first();
            }

            $pdf = PDF::loadView('pdf.invoicepdf', compact('selectedOrderIds', 'leads'));
            return $pdf->download('pdf.invoicepdf');
        } else {
            // Return error message
            return redirect()->back()->with('error', 'No data selected....plz select atleast one row');
        }

    }

    /**
     *  $leads = Lead::join('orders', 'leads.id', '=', 'orders.lead_id')
        ->whereIn('orders.id', $selectedOrderIds)
        ->get(['leads.id', 'leads.first_name', 'leads.last_name', 'orders.id as order_id']);

     */
    public function selectedPrescriptions(Request $request)
    {
        // Retrieve the selected order IDs from the request
        $selectedOrderIds = explode(',', $request->input('ids'));

        if ($request->ids) {
            $leads = [];

            foreach ($selectedOrderIds as $key => $value) {
                $order = Order::find($value);
                $leads[] = Lead::with('order')->where('id', $order->lead_id)->first();
            }
            // return view('pdf.prescriptionPdf', compact('selectedOrderIds', 'leads'));

            $pdf = PDF::loadView('pdf.prescriptionPdf', compact('selectedOrderIds', 'leads'));
            return $pdf->download('pdf.prescriptionPdf');
        } else {
            // Return error message
            return redirect()->back()->with('error', 'No data selected....plz select atleast one row');
        }
    }

    public function sendPrescriptionLink(Request $request)
    {
        $leads = Lead::with('order')->where('prescription_link', 0)->get();
        foreach ($leads as $lead) {

            $token = self::generateToken();
            $prescriptionLink = new PrescriptionToken();
            $prescriptionLink->lead_id = $lead->id;
            $prescriptionLink->order_id = $lead->order->id;
            $prescriptionLink->token = $token;
            $prescriptionLink->save();

            $viewPrescriptionLink = url("/viewprescription/{$token}");
            $mailData = [
                'title' => 'Check Your Prescription Here...',
                'body' => ' click this link !!!' . $viewPrescriptionLink,
            ];

            Mail::to($lead->email)->send(new MailForPrescription($mailData));

            $lead->prescription_link = 1;
            $lead->save();


        }

    }

    public function viewPrescription($token)
    {
        $prescriptionData = PrescriptionToken::with('lead')->where('token', $token)->first();
        // dd($prescriptionData);
        if ($prescriptionData && $prescriptionData->lead) {
            // Check if the lead has an associated order
            if ($prescriptionData->lead->order) {
                return view('viewprescriptionfromemail', compact('prescriptionData'));
            }
        }


    }

    public function viewInvoice($id)
    {
        $invoice = Lead::with('order.invoice')->where('id', $id)->first();

        if ($invoice && $invoice->order) {
            return view('viewinvoiceforemail', compact('invoice'));
        }
    }



    public static function generateToken()
    {
        return bin2hex(random_bytes(32));
    }







    public function exportShippingFrom(Request $request)
    {
        $selectedOrderIds = explode(',', $request->input('ids'));

        // $data = Lead::where('converted_to_order', '1')->with('order')->get();
        if ($request->ids) {

            // return view('pdf.shippingLabelFromPdf', compact('selectedOrderIds'));
            $pdf = PDF::loadView('pdf.shippingLabelFromPdf', compact('selectedOrderIds'));
            return $pdf->download('pdf.shippingLabelFromPdf');
        } else {
            return back()->with('errormessage', 'please select atleast one row');
        }
    }
    public function exportShippingTo(Request $request)
    {
        $selectedOrderIds = explode(',', $request->input('ids'));
        if ($request->ids) {
            $leads = [];

            foreach ($selectedOrderIds as $key => $value) {
                $order = Order::find($value);
                $leads[] = Lead::with('order')->where('id', $order->lead_id)->first();
            }

            $pdf = PDF::loadView('pdf.shippingLabelToPdf', compact('selectedOrderIds', 'leads'));
            return $pdf->download('pdf.shippingLabelToPdf');
        } else {
            // Return error message
            return redirect()->back()->with('error', 'No data selected....plz select atleast one row');
        }
    }




    public function getInvoiceShipped(Request $req)
    {
        $selectedOrders = $req->input('selectedOrders');

        if ($req->expectsJson()) {
            // If the request expects JSON, return the data
            return response()->json(['url' => route('orders.invoices.shipped', compact('selectedOrders'))]);
        } else {
            // If not, render the Blade view
            return view('pdf.invoicepdfshipped', compact('selectedOrders'));
        }
    }



}
