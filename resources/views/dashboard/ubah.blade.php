<!-- Menghubungkan dengan view template master -->
@extends('dashboard/templates')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Tambah Data Buku')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('kontens')


<div class="container">
    @if(session('pesan'))
    <div class="alert alert-danger">
        <b>Yeahh!!</b> {{session('pesan')}}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-4">
            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach($buku as $d)
                <input type="hidden" name="id" class="form-control" value="{{$d->id}}">
                <input type="hidden" name="gambar_lama" value="{{$d->gambar}}" class="form-control">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="judul">Judul Buku</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{$d->judul}}">
                            @error('judul')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="judul">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{$d->deskripsi}}</textarea>
                            @error('deskripsi')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="judul">Penulis</label>
                            <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{$d->penulis}}">
                            @error('penulis')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="judul">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" value="{{$d->penerbit}}">
                            @error('penerbit')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <img src="{{asset('images/'.$d->gambar)}}" alt="gambar" class="img-fluid mb-2" />
                            <label for="judul">Gambar</label>
                            <input type="file" name="gambar_baru" class="form-control @error('gambar_baru') is-invalid @enderror">
                            @error('gambar_baru')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="judul">Tanggal Terbit</label>
                            <input type="date" class="form-control @error('tlg_terbit') is-invalid @enderror" name="tgl_terbit" value="{{$d->tgl_terbit}}">
                            @error('tgl_terbit')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary mt-4">Ubah</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>

@endsection