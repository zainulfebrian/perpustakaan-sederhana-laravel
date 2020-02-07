<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = "Anggota";
        $data['active'] = "anggota";
        
        $data['listanggota'] = DB::table('anggota')->get();

        return view('anggota')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anggota = new Anggota;
        // $anggota->idanggota = uniqid();
        $anggota->nama = $request->namaanggota;
        $anggota->kelas = $request->kelas;

        $anggota->save();

        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::find($id);
        echo json_encode($anggota);
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        $anggota->nama = $request->nama;
        $anggota->kelas = $request->kelas;

        if($anggota->save()){
            $request->session()->flash('success', 'Data berhasil diedit');
        }else{
            $request->session()->flash('error', 'Data gagal di edit');
        }

        return redirect('/anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Anggota::find($id);

        if($buku->delete()){
            session()->flash('success', 'Data Berhasil Dihapus');
        }else{
            session()->flash('errorr', 'Data Gagal dihapus');
        }

        return redirect('/anggota');
        
        return redirect('/anggota');
    }
}
