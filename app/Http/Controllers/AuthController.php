<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Log;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $credentials = $request->only('username', 'password');
            if(Auth::attempt($credentials)) {
                Log::store('Logged in system');
                return redirect('/');
            } else {
                return redirect('login')->with('alert',"username dan password tidak sesuai");
            }
        } catch(\Throwable $th)
        {
            return $th->getMessage();
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function reset()
    {
        return view('auth.reset');
    }

    public function send(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        } catch(\Throwable $th) {
            return $th->getMessage();
        }
    }
}
