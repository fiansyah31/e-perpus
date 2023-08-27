@extends('template')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
@section('judul', 'Form Register')
<div class="col-md-6">
    <hr>
    @if(session('pesan'))
    <div class="alert alert-danger">
        <b>Opps!</b> {{session('pesan')}}
    </div>
    @endif
    <form action="{{ route('prosesregister')}}" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required="">
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Email" required="">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <hr>
        <p class="text-center">Sudah punya akun? <a href="/login">Login</a> sekarang!</p>
    </form>
</div>


@endsection