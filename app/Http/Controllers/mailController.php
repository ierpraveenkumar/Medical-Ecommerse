<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail title',
            'body' => 'Mail body',
        ];

        Mail::to('p7484823093@gmail.com')->send(new DemoMail($mailData));

    }

    
}
