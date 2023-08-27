<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;



class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard/index', ['title' => $title]);
    }

    public function databuku()
    {
        $title = 'Data Buku';
        $buku = BukuModel::select("*")->get();
        return view('dashboard/data', ['buku' => $buku, 'title' => $title]);
    }
    public function ubah($id)
    {
        $title = 'Ubah Buku';
        $buku = BukuModel::select("*")->where('id', $id)->get();
        return view('dashboard/ubah', ['buku' => $buku, 'title' => $title]);
    }
    public function update(Request $request)
    {

        $validate =  $request->validate(
            [
                'judul' => 'required',
                'deskripsi' => 'required|max:300', // Maksimal 300 kata
                'penulis' => 'required',
                'penerbit' => 'required',
                'gambar_baru' => 'image|mimes:jpeg,png,jpg|max:2048',
                'tgl_terbit' => 'required|date'
            ],
            [
                'judul.required' => 'Harus diisi!',
                'deskripsi.required' => 'Harus diisi!',
                'deskripsi.max' => 'Panjang maksimal 300',
                'penulis.required' => 'Harus diisi!',
                'penerbit.required' => 'Harus diisi!',
                'gambar_baru.mimes' => 'Gambar harus berekstensi jpg,png,jpg',
                'gambar_baru.image' => 'File harus berbentuk gambar',
                'gambar_baru.max' => 'Gambar harus max berukuran 2mb',
                'tgl_terbit.required' => 'Harus diisi!',
                'tgl_terbit.date' => 'Harus diisi dengan tanggal!'
            ]
        );


        if ($request->hasFile('gambar_baru')) { //jika ada upload gambar baru
            $gambarBaru = $request->file('gambar_baru'); //tampung gambarnya

            $image = time() . '-' . $gambarBaru->getClientOriginalName(); //ubah namanya

            $id = $request->id; //ambil id data
            $data = BukuModel::find($id); //cari berdasarkan id
            $gambarPath = public_path('images/' . $data->gambar); //cari gambar lama di folder berdasarkan id

            if (file_exists($gambarPath)) { //jika ditemukan hapus
                unlink($gambarPath); // hapus gambar pada folder
            }
            $gambarBaru->move(public_path('images'), $image); //pindahkan gambar baru ke folder
        } else { //jika tidak ada upload gambar baru
            $image = $request->gambar_lama; //tampung gambar lama
        }

        $update = BukuModel::where('id', $request->id)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'gambar' => $image,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        if ($update) {
            Session::flash('success', 'Buku berhasil diperbarui');
            return redirect()->route('buku');
        } else {
            Session::flash('error', 'Buku gagal diperbarui');
            return redirect()->route('buku');
        }
    }
    public function hapus($id)
    {
        $data = BukuModel::find($id);
        if (!$data) {
            Session::flash('error', 'Buku tidak ditemukan');
            return redirect()->route('buku');
        }
        $gambarPath = public_path('images/' . $data->gambar);

        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }


        $update = BukuModel::where('id', $id)->delete();
        if ($update) {

            Session::flash('success', 'Buku berhasil dihapus');
            return redirect()->route('buku');
        } else {
            Session::flash('error', 'Buku gagal dihapus');
            return redirect()->route('buku');
        }
    }
    public function tambahbuku()
    {
        $title = 'Tambah Buku';
        return view('dashboard/tambah-buku', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $validate =  $request->validate(
            [
                'judul' => 'required',
                'deskripsi' => 'required|max:300', // Maksimal 300 kata
                'penulis' => 'required',
                'penerbit' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'tgl_terbit' => 'required|date'
            ],
            [
                'judul.required' => 'Harus diisi!',
                'deskripsi.required' => 'Panjang kata maksimal 300',
                'deskripsi.max' => 'Panjang maksimal 300',
                'penulis.required' => 'Harus diisi!',
                'penerbit.required' => 'Harus diisi!',
                'gambar.required' => 'Gambar harus diisi!',
                'gambar.mimes' => 'Gambar harus berekstensi jpg,png,jpg',
                'gambar.image' => 'File harus berbentuk gambar',
                'gambar.max' => 'Gambar harus max berukuran 2mb',
                'tgl_terbit.required' => 'Harus diisi!',
                'tgl_terbit.date' => 'Harus diisi dengan tanggal!'
            ]
        );

        $gambar = $request->file('gambar');
        $imageName = time() . '-' . $gambar->getClientOriginalName(); // Menggunakan getClientOriginalName() untuk mendapatkan nama asli file

        $save = BukuModel::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'gambar' => $imageName,
            'tgl_terbit' => $request->tgl_terbit
        ]);

        if ($save) {
            $gambar->move(public_path('images'), $imageName); // Memindahkan gambar ke direktori publik

            Session::flash('success', 'Buku berhasil ditambahkan');
            return redirect()->route('buku');
        } else {
            Session::flash('error', 'Buku gagal ditambahkan');
            return redirect()->route('tambahbuku');
        }
    }
}
