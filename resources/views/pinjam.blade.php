@extends('layout')

@section('title', $title)

@section('content')
    
    <div class="container mt-4">
        <!-- Button trigger modal -->
        
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pinjam" style="margin-bottom: 35px;">Pinjam Buku
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
        
        <table class="table table-striped" id="tabel-pinjam">
           <thead>
           <tr>
                <td>No</td>
                <td>Kode Pinjam</td>
                <td style="width: 240px;">Buku</td>
                <td>Pilih Anggota</td>
                <td>Tanggal Pinjam</td>
                <td>Tanggal Kembali</td>
                <td>Status</td>
                <td>Opsi</td>
            </tr>
           </thead>
            <tbody>
            @php $no=1 @endphp

            @foreach($listpinjam as $d)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$d->kodepinjam}}</td>
                <td>{{$d->judul}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->tglpinjam}}</td>
                <td>{{$d->tglkembali}}</td>
                <td>
                    @if($d->status==0)
                        <span class="badge badge-primary">Kembali</span>
                    @else
                        <span class="badge badge-danger">Di pinjam</span>
                    @endif
                </td>
                <td class="d-inline-flex">
                <button class="btn btn-warning mr-2 edit-pinjam" itemid="{{$d->idpinjam}}"><i class="far fa-edit"></i></button>
                    <form action="/pinjam/{{$d->idpinjam}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

        <!-- Modal Tambah Buku -->
    <div class="modal fade" id="pinjam" tabindex="-1" role="dialog" aria-labelledby="pinjam" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah">Pinjam Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form action="/pinjam" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">ID Pinjam</label>
                        <input type="text" class="form-control" name="idpinjam" placeholder="Masukkan ID Pinjam">
                        <label for="">Kode Pinjam</label>
                        <input type="text" class="form-control" name="kodepinjam" placeholder="Masukkan Kode Pinjam">
                        <label for="">Pilih Buku</label>
                        <select class="form-control" id="daftarBuku" name="idbuku">
                            <option readonly="">--Pilih Buku--</option>
                            
                            @foreach ($listbuku as $b)
                            <option value="{{$b->idbuku}}">{{$b->idbuku}} - {{$b->judul}}</option>
                            @endforeach

                        </select>
                        <label for="">Pilih Anggota</label>
                        <select class="form-control" id="daftarAnggota" name="idanggota">
                        <option readonly="">--Pilih Anggota--</option>
                        @foreach($listanggota as $a)
                            <option value="{{$a->idanggota}}">{{$a->idanggota}} - {{$a->nama}}</option>
                        @endforeach
                        </select>
                        <label>Tanggal Pinjam</label>
                        <input type="date" class="form-control" name="tglpinjam">
                        <label>Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tglkembali">
                        <label>Status</label>
                        <select name="statusbuku" id="statusbuku">
                            <option value="0">0 - Kembali</option>
                            <option value="1">1 - Di Pinjam</option>
                        </select>
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

    <!-- MODAL EDIT PINJAM -->
    <div class="modal fade" id="edit-pinjam" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit">Edit Pinjam Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form action="/pinjam" id="form-edit" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">ID Pinjam</label>
                        <input type="text" class="form-control" disabled name="idpinjam" id="idpinjam" placeholder="Masukkan ID Pinjam">
                        <label for="">Kode Pinjam</label>
                        <input type="text" class="form-control" disabled name="kodepinjam" id="kodepinjam" placeholder="Masukkan Kode Pinjam">
                        <label for="">Pilih Buku</label>
                        <select class="form-control" id="judulBuku" name="idbuku">
                            <option readonly="">--Pilih Buku--</option>
                            
                            @foreach ($listbuku as $b)
                            <option value="{{$b->idbuku}}">{{$b->idbuku}} - {{$b->judul}}</option>
                            @endforeach

                        </select>
                        <label for="">Pilih Anggota</label>
                        <select class="form-control" id="namaAnggota" name="idanggota">
                        <option readonly="">--Pilih Anggota--</option>
                        @foreach($listanggota as $a)
                            <option value="{{$a->idanggota}}">{{$a->idanggota}} - {{$a->nama}}</option>
                        @endforeach
                        </select>
                        <label>Tanggal Pinjam</label>
                        <input type="date" class="form-control" name="tglpinjam" id="tglpinjam">
                        <label>Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tglkembali" id="tglkembali">
                        <label>Status</label>
                        <select name="statusbuku" id="status" class="form-control">
                            <option value="0">0 - Kembali</option>
                            <option value="1">1 - Di Pinjam</option>
                        </select>
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

@endsection