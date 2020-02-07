@extends('layout')

@section('title','Perpustakaan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-4">
                <div class="jumbotron">
                    <div class="container">
                        <h1 class="display-4">Selamat Datang Di Perpustakaan</h1>
                        <p class="lead">Anda bisa meminjam dan membeli buku disini</p>
                        <hr class="my-4">
                        <div class="row justify-content-center">
                            <a class="btn btn-success btn-lg mr-2" href="pinjam" role="button">Pinjam Buku</a>
                            <a class="btn btn-danger btn-lg mr-2" href="buku" role="button">Daftar Buku</a>        
                            <a class="btn btn-warning btn-lg mr-2" href="anggota" role="button">Anggota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection