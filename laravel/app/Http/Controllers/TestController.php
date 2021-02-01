<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TestController extends Controller
{
    //ログインフォームのgetリクエスト（初期画面）
    function test()
    {
        return view('test');
    }

    //ログインフォームのpostリクエスト（ログインチェック）
    function testPos(Request $request)
    {
        $rules = [
            'mail' => 'email'
        ];

        $messages = [
            'mail.email' => 'メールドレスを正しく入力して下さい'
        ];
        $result = Validator::make($request->all(), $rules, $messages);

        //入力のバリデーション
        //fails関数はエラーがあればtrue、なければfalse
        if ($result->fails()) {
            return  redirect('\test')->withErrors($result)->withInput();
        } else {
            $email = $request->mail;
            $password = $request->password;

            //ログインチェック attempt関数の戻り値がtureならログイン、falseなら初期画面をview関数でリロード
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->put('name', Auth::user()->name);
                return redirect('\top');
            } else {
                $dbErrorMessage = 'メールアドレスかパスワードが間違っています';
                return view('test', ['dbErrorMessage' => $dbErrorMessage]);
            }
        }
    }

    //トップ画面のアクション Authのcheck関数でログインチェックを行う、falseならログイン画面へリダイレクト
    function top(Request $request)
    {
        if (Auth::check()) {
            $userNme = $request->session()->get('name');
            return view('top', ['userName' => $userNme]);
        } else {
            return redirect('test');
        }
    }

    //ログアウトのリンクを踏んだ際のアクション
    function logout()
    {
        Auth::logout();
        return redirect('test');
    }
}
