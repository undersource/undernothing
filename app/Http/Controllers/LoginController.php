<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller {
    public function form(Request $request) {
        $title = 'Login';

        return view('login', compact('title'));
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string', 'max:100'],
            'captcha'   => ['required', 'captcha']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'Invalid login or password.'
        ]);
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('index');
    }
}
