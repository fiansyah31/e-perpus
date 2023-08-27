<!-- Menghubungkan dengan view template master -->
@extends('dashboard/templates')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Data Buku')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('kontens')

<div class="container">
    <br>
    @if(session('success'))
    <div class="alert alert-success">
        <b>Yeahhh!!</b> {{session('success')}}
    </div>
    @endif

    <a href="{{route('tambahbuku')}}" class="btn btn-primary">Tambah Buku</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Judul</td>
                <td>Penulis</td>
                <td>Penerbit</td>
                <td>Tanggal Terbit</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $d)
            <tr>
                <td>{{$d->judul}}</td>
                <td>{{$d->penulis}}</td>
                <td>{{$d->penerbit}}</td>
                <td>{{$d->tgl_terbit}}</td>
                <td><a href="/dashboard/buku/ubah/{{$d->id}}">Ubah</a> | <a href="/dashboard/buku/hapus/{{$d->id}}">Hapus</a> | <a href="/dashboard/buku/read/{{$d->id}}">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection