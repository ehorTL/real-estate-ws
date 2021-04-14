<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function handleFeedbackForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'text' => 'required|max:500',
            'subject' => 'present|max:250',
            'email' => 'present',
            'tel' => 'present',
        ]);

        Mail::to(env('SEND_FEEDBACK_FORM_ADDRESS_TO'))
            ->send(new FeedbackFormMail($data));
    }
}
