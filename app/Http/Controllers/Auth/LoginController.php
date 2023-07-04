<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function signup()
    {
        return view('auth.signup');
    }

    // Fungsi untuk melakukan proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::attempt($credentials)) {
            
                if ( Auth::user()->roles->first()->role_name == "Customer" ) {
                    return redirect(route('home'));
                } else {
                    return redirect()->intended('/dashboard');
                }
            } else {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }
        } else {
            // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    // Fungsi untuk melakukan logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
