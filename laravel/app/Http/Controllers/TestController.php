<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $email = $request->email;
        $password = $request->password;

        //ログインチェック attempt関数の戻り値がtureならログイン、falseなら初期画面へリダイレクト
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->put('name', Auth::user()->name);
            return redirect('\top');
        } else {
            return redirect('\test');
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
