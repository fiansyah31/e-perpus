<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login()
    {
        //digunakan untuk memeriksa apakah user sudah login atau belum. Jika sudah, maka user akan kita arahkan ke halaman utama yaitu halaman home.
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('/');
        }
    }

    public function proseslogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        //berfungsi untuk melakukan proses pengecekan validasi login langsung ke table users dan memberikan fasilitasi session jika berhasil login.
        if (Auth::Attempt($data)) {
            return redirect('dashboard');
        } else {
            Session::flash('pesan', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function prosesregister(Request $request)
    {

        $user = User::create([
            'email' => $request->email,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 1
        ]);

        Session::flash('pesan', 'Register Berhasil');
        return redirect('register');
    }
}
