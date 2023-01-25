<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\ContactRequest;

class MailController extends Controller
{
    public function index()
    {
        //フォーム入力画ページのviewを表示
        return view('contact.index');
    }

    public function confirm(Request $request)
    {
        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();

        //入力内容確認ページのviewに変数を渡して表示
        return view('contact.confirm', [
            'inputs' => $inputs,
        ]);
    }

    public function send(Request $request)
    {
        
        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('contact.index')
                ->withInput($inputs);

        } else {
            //入力されたメールアドレスにメールを送信
            Mail::to($inputs['email'])->send(new ContactMail($inputs));

            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            //送信完了ページのviewを表示
            return view('contact.thanks');
            
        }
    }
}