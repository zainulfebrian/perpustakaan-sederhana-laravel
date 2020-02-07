<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('datatables.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-book-open fa-lg mr-2"></i>PERPUSTAKAAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if($active == "home"){echo "active";}?>" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if($active =="buku"){echo 'active';} ?>">
                    <a class="nav-link" href="/buku">Buku</a>
                </li>
                <li class="nav-item <?php if($active == "anggota"){echo 'active';}?>">
                    <a class="nav-link" href="/anggota">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($active == "pinjam"){echo 'active';}?>" href="/pinjam">Pinjam</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    
    @yield('content')

    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatables.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#tabel-buku').DataTable({
                "columnDefs":[
                    {"orderable": false, "targets": 3}
                ]
            });
            $('#tabel-pinjam').DataTable({
                "columnDefs":[
                    {"orderable": false, "targets": 5}
                ]
            });
            $('#tabel-anggota').DataTable({
                "columnDefs":[
                    {"orderable": false, "targets": 3}
                ]
            });
        });

        $('.edit-buku').on('click', function(){
            const id = $(this).attr('itemid');
            $('#form-edit').trigger('reset');
            $.ajax({
                url : '/buku/'+id+'/edit',
                type : 'GET',
                success:function(result){
                    var data = JSON.parse(result);
                    $('#edit-judul').val(data.judul);
                    $('#edit-pengarang').val(data.pengarang);
                    $('#form-edit').attr('action', '/buku/' + data.idbuku);
                    $('#modal-edit').modal('show');
                }
            })
        })

        $('.edit-anggota').on('click', function(){
            const id = $(this).attr('itemid');
            $('#form-edit').trigger('reset');
            $.ajax({
                url : '/anggota/'+id+'/edit',
                type : 'GET',
                success:function(result){
                    var data = JSON.parse(result);
                    $('#edit-nama').val(data.nama);
                    $('#edit-kelas').val(data.kelas);
                    $('#form-edit').attr('action', '/anggota/' + data.idanggota);
                    $('#modal-edit').modal('show');
                }
            })
        })

        $('.edit-pinjam').on('click', function(){
            const id = $(this).attr('itemid');
            $('#form-edit').trigger('reset');
            $.ajax({
                url: '/pinjam/' + id + '/edit',
                type: 'GET',
                success:function(result){
                    var data = JSON.parse(result);

                    $('#idpinjam').val(data.idpinjam);
                    $('#kodepinjam').val(data.kodepinjam);
                    $('#judulBuku').val(data.idbuku);
                    $('#namaAnggota').val(data.idanggota);
                    $('#tglpinjam').val(data.tglpinjam);
                    $('#tglkembali').val(data.tglkembali);
                    $('#status').val(data.status);
                    $('#form-edit').attr('action', '/pinjam/' + data.idpinjam);
                    $('#edit-pinjam').modal('show');
                }
            })
        })
    </script>
    
</body>
</html>