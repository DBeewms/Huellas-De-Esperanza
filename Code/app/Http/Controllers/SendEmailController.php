<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMailMailable;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    //
    public function sendEmail($sento, $subject, $message)
    {
        $details = [
            'title' => $subject,
            'body' => $message
        ];

        Mail::to($sento)->send(new MyMailMailable($details));
    }

}
