<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
                // Log::create([
                //     'user'        => $request->username,
                //     'activity'    => 'Login',
                //     'description' => $request->username . " telah login pada " . Carbon::now('Asia/Makassar')
                // ]);
                return redirect('/');
            } else {
                return redirect('login')->with('alert',"username dan password tidak sesuai");
            }
        } catch(\Throwable $th)
        {
            return redirect()->back();
        }
    }
}
