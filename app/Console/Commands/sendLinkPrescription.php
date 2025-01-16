<?php

namespace App\Console\Commands;

use App\Http\Controllers\DomPdfController;
use Illuminate\Console\Command;
use App\Models\Lead;
use App\Models\PrescriptionToken;
use App\Mail\MailForPrescription;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Log;

class sendLinkPrescription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:prescription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send prescription link whose did not receive their prescription';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $leads = Lead::with('order')->where('prescription_link', 0)->get();
        // Log::debug($leads);
        foreach ($leads as $lead) {
            $token = DomPdfController::generateToken();
            $prescriptionLink = new PrescriptionToken();
            $prescriptionLink->lead_id = $lead->id;
            $prescriptionLink->token = $token;
            $prescriptionLink->save();

            $viewPrescriptionLink = url("viewprescription/{$token}");
            $mailData = [
                'title' => 'Check Your Prescription Here...',
                'body' => ' click this link !!!' . $viewPrescriptionLink,
            ];

            Mail::to($lead->email)->send(new MailForPrescription($mailData));

            $lead->prescription_link = 1;
            $lead->save();
          

        }
    }
}
