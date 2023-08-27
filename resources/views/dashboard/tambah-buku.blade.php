<!-- Menghubungkan dengan view template master -->
@extends('dashboard/templates')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Tambah Data Buku')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('kontens')


<div class="container">
    @if(session('error'))
    <div class="alert alert-danger">
        <b>Oppss!!</b> {{session('error')}}
    </div>
    @endif
    <form action="{{route('simpanbuku')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul">Judul Buku</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{old('judul')}}" placeholder="Judul Buku">
            @error('judul')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="judul">Deskripsi</label>
            <textarea type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi"> {{old('deskripsi')}}</textarea>
            @error('deskripsi')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="judul">Penulis</label>
            <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{old('penulis')}}" placeholder="Penulis Buku">
            @error('penulis')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="judul">Penerbit</label>
            <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" value="{{old('penerbit')}}" placeholder="Penerbit Buku">
            @error('penerbit')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="judul">Gambar</label>
            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
            @error('gambar')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="judul">Tanggal Terbit</label>
            <input type="date" name="tgl_terbit" class="form-control @error('tgl_terbit') is-invalid @enderror">
            @error('tgl_terbit')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
</div>

@endsection