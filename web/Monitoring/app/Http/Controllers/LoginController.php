<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'nama' => $request->nama,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            // regenerate session to prevent session fixation
            $request->session()->regenerate();

            // set a flash message
            Session::flash('success', 'Berhasil login');
            return redirect()->route('admin.dashboard');
        } else {
            // set a flash message
            Session::flash('failed', 'Nama atau Password salah');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        // invalidate the session and regenerate the token to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // set a flash message
        Session::flash('success', 'Kamu berhasil logout');
        return redirect()->route('login');
    }
}




