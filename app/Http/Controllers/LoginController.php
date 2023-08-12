<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data =[
            'content' => 'auth/login'
        ];
        return view('layouts.wrapper', $data);
    }

    public function doLogin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect("admin/dashboard");
        }

        return back()->with("loginError", "Gagal login, Username atau password tidak ditemukan");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/");
    }
}