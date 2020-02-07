@extends('layout')

@section('title', $title)

@section('content')
    
    <div class="container mt-4">
        <!-- Button trigger modal -->
        
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahBuku" style="margin-bottom: 35px;">Pinjam Buku
        </button>
        
        @if($pesan = Session::get('errorr'))

        <div class="alert alert-danger alert-dismissible fade show">
            {{$pesan}}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if($pesan = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{$pesan}}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <table class="table table-striped" id="tabel-anggota">
           <thead>
           <tr>
                <td>No.</td>
                <td>Nama</td>
                <td>Kelas</td>
                <td>Opsi</td>
            </tr>
           </thead>
            <tbody>
            @php $no=1 @endphp
            @foreach($listanggota as $d)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->kelas}}</td>
                <td class="d-inline-flex">
                    <button class="btn btn-warning edit-anggota mr-2" itemid="{{$d->idanggota}}"><i class="far fa-edit"></i></button>
                    <form action="/anggota/{{$d->idanggota}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    
        <!-- Modal Tambah Buku -->
        <div class="modal fade" id="tambahBuku" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambah">Tambah Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <form action="/anggota" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">ID Anggota</label>
                            <input type="text" class="form-control" name="idaanggota" placeholder="Masukkan ID Buku">
                            <label for="">Nama Anggota</label>
                            <input type="text" class="form-control" name="namaanggota" placeholder="Masukkan Judul Buku">
                            <label for="">Kelas</label>
                            <input type="text" class="form-control" name="kelas" placeholder="Masukkan Pengarang Buku">
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
                <form action="/anggota" id="form-edit" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Anggota</label>
                        <input type="text" class="form-control" name="nama" id="edit-nama" placeholder="Masukkan Nama Amggota">
                        <label for="">Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="edit-kelas" placeholder="Masukkan Kelas Anggota">
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