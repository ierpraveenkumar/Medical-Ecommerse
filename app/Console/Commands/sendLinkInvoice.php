<?php

namespace App\Console\Commands;

use App\Http\Controllers\DomPdfController;
use App\Mail\MailForInvoice;
use App\Models\Invoice;
use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendLinkInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoices = Lead::where('invoice_sent', 0)->get();

        foreach ($invoices as $invoice) {
          

            $viewInvoiceLink = url("viewInvoice/{$invoice->id}");
            $mailData = [
                'title' => 'Click the Invoice link to check your prescription Here...',
                'body' => ' click this link !!!' . $viewInvoiceLink,
            ];

            Mail::to($invoice->order->lead->email)->send(new MailForInvoice($mailData));

            $invoice->invoice_sent = 1;
            $invoice->save();
          

        }
     }
}
