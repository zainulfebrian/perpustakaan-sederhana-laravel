<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pinjam;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = "Pinjam";
        $data['active'] = "pinjam";

        $data['listpinjam'] = DB::table('qpinjam')->get();
        $data['listanggota'] = DB::table('anggota')->get();
        $data['listbuku'] = DB::table('buku')->get();
        return view('pinjam')->with($data);
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
        $data = new Pinjam;
        $data->idpinjam = $request->idpinjam;
        $data->kodepinjam = uniqId();
        $data->idbuku = $request->idbuku;
        $data->idanggota = $request->idanggota;
        $data->tglpinjam = $request->tglpinjam;
        $data->tglkembali = $request->tglkembali;
        $data->status = $request->statusbuku;

        $data->save();

        return redirect('/pinjam');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Ini adalah halaman pinjam';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        echo json_encode($pinjam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Pinjam::find($id);
        $data->idbuku = $request->idbuku;
        $data->idanggota = $request->idanggota;
        $data->tglpinjam = $request->tglpinjam;
        $data->tglkembali = $request->tglkembali;
        $data->status = $request->statusbuku;

        if($data->save()){
            $request->session()->flash('success', 'Data Berhasil Di Edit');
        }else{
            $request->session()->flash('error', 'Data Gagal Di Edit');
        }

        return redirect('/pinjam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pinjam::find($id);
        $data->delete();
        return redirect('/pinjam');
    }
}
