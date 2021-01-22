<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    function test()
    {
        return view('test');
    }

    function testPos(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->put('name', Auth::user()->name);
            return redirect('\top');
        } else {
            return redirect('\test');
        }
    }

    function top(Request $request)
    {
        if (Auth::check()) {
            $userNme = $request->session()->get('name');
            return view('top', ['userName' => $userNme]);
        } else {
            return redirect('test');
        }

    }

    function logout()
    {
        Auth::logout();
        return redirect('test');
    }
}
