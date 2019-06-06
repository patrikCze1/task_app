<?php

namespace App\Http\Controllers;

use App\Mail\JobAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class MailController extends Controller
{
    public function send(Request $request){

        $data = array(
            'mail' => 'laravel@email',
            'answer' => $request->input('answer'),
            'userMail' => 'user@email'
        );

        Mail::send('mails.mail', $data, function($message) {
            $message->to('registered-user@gmail.com', 'Jon Doe');
            $message->subject('Welcome to the Laravel 4 Auth App!');
        });

        return view('mails/mailsended');
    }

    public function mailSended(){
        return redirect('mails/mailsended')->with('success', 'Mail sended');
    }
}
