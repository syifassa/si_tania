<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLanding()
    {
        return view('landing');
    }

    public function showLoginWarga()
    {
        return view('auth.login-warga');
    }

    public function showLoginAdmin()
    {
        return view('auth.login-admin');
    }

    public function loginWarga(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ], $request->remember)) { 
            $request->session()->regenerate();
            return redirect()->route('warga.beranda');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }   

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ], $request->remember)) { 
            $request->session()->regenerate();
            return redirect()->route('admin.beranda');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
