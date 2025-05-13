<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailTester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    # Testing!
    public function sendMail()
    {
        Mail::to('fake@email.com')->send(new MailTester("Zuki", "Zuki@fakemail.com"));
    }
}
