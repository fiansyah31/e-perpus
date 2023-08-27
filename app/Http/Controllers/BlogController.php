<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function index()
    {
        $nama = 'Belajar Laravael';
        $alat = ['Laptop', 'internet', 'Niat yang semangat'];
        return view('blog', ['nama' => $nama, 'alat' => $alat]);
    }

    public function getNama($nama)
    {
        return $nama;
    }

    public function pendaftaran()
    {
        return view('pendaftaran');
    }

    public function proses(Request $resquest)
    {
        $nama = $resquest->nama;
        $alamat = $resquest->alamat;
        return 'Nama :' . $nama . 'Alamat :' . $alamat;
    }
}
