<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{

    public function index()
    {
        return view('mail.index');
    }

    public function send(Request $request)
    {
        $name = $request['name'];

        Mail::send(new ContactMail($name));

        session()->flash('success', '送信しました！');
        return back();
    }
}
