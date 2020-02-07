@extends('layout')

@section('title', $title)

@section('content')
    
    <div class="container mt-4 mb-4">
        <!-- Button trigger modal -->
        
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 35px;">Tambah Buku
        </button>

        @if($pesan = Session::get('error'))

        <div class="alert alert-danger alert-dismissible fade show">
            {{$pesan}}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if($pesan = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show">
            {{$pesan}}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <table class="table table-striped" id="tabel-buku">
           <thead>
           <tr>
                <td>No.</td>
                <td>Judul Buku</td>
                <td>Pengarang</td>
                <td>Opsi</td>
            </tr>
           </thead>
            <tbody>
            <?php $a= 1; ?>
            @foreach($listbuku as $buku)
            <tr>
                <td>{{$a++}}</td>
                <td>{{$buku->judul}}</td>
                <td>{{$buku->pengarang}}</td>
                <td class="d-inline-flex">
                <a href="#" class="btn btn-warning edit-buku mr-2" itemid="{{$buku->idbuku}}"><i class="far fa-edit"></i></a>
                <form action="/buku/{{$buku->idbuku}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/buku" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">ID Buku</label>
                            <input type="text" class="form-control" name="idbuku" placeholder="Masukkan ID Buku">
                            <label for="">Judul Buku</label>
                            <input type="text" class="form-control" name="judulbuku" placeholder="Masukkan Judul Buku">
                            <label for="">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" placeholder="Masukkan Pengarang Buku">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" >Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/buku" id="form-edit" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Judul Buku</label>
                        <input type="text" class="form-control" name="judulbuku" id="edit-judul" placeholder="Masukkan Judul Buku">
                        <label for="">Pengarang</label>
                        <input type="text" class="form-control" name="pengarang" id="edit-pengarang" placeholder="Masukkan Pengarang Buku">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection