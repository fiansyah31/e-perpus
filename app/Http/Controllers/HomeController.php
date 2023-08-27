<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
        return view('login');
    }
}
