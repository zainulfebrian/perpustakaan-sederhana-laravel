<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = "Buku";
        $data['active'] = "buku";

        $data['listbuku'] = DB::table('buku')->get();
        return view('buku')->with($data);
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
        //
        // $request->session()->forget(['error', 'success']);
        if($request->judulbuku === null || $request->pengarang === null){
            $request->session()->flash('error', 'Data Masih Kosong');
        }else{
            $buku = new Buku;
            $buku->judul = $request->judulbuku;
            $buku->pengarang = $request->pengarang;
            $buku->save();

            if($buku->save()){
                $request->session()->flash('success', 'Data Berhasil Di inputkan');
            }else{
                $request->session()->flash('error', 'Data Gagal dimasukkan');
            }
        }
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'buku' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        echo json_encode($buku);
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
        $buku = Buku::find($id);
        $buku->judul = $request->judulbuku;
        $buku->pengarang = $request->pengarang;

        if($buku->save()){
            $request->session()->flash('success', 'Data Berhasil Di Edit');
        }else{
            $request->session()->flash('error', 'Data Gagal Di Edit');
        }

        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if($buku->delete()){
            session()->flash('success', 'Data Berhasil Di Hapus');
        }else{
            session()->flash('error', 'Data Gagal dihapus');
        }
        return redirect('/buku');
    }
}
