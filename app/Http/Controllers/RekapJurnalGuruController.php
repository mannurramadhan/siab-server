<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class RekapJurnalGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DB::table('rekapjurnalguru')->paginate(10);
        $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM rekapjurnalguru");
        $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM rekapjurnalguru");

        return view('pages.rekapan_jurnal_guru.index', compact('index', 'kelas', 'mapel'));
    }

    /**
     * Show the form for printing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $id1 = $request->id1;
        $id2 = $request->id2;

        if($id1 != null && $id2 != null)
        {
            $getKelas = DB::table('kelas')->where('Id_Kelas', '=', $id1)->first();
            $namaKelas = $getKelas->Tingkat_Kelas.' '.$getKelas->Jurusan.' '.$getKelas->Nomor_Kelas;
            $getMapel = DB::table('matapelajaran')
                        ->where('Nama_Mapel', '=', $id2)
                        ->where('Kelas_Mapel', '=', $namaKelas)
                        ->first();
            
            $get = DB::table('jurnalguru')
                        ->where('Id_Kelas', '=', $id1)
                        ->where('Id_Mapel', '=', $getMapel->Id_Mapel)
                        ->first();
            
            if($get != null){
                return view('pages.rekapan_jurnal_guru.print', ['id1'=>$id1, 'id2'=>$getMapel, 'get'=>$get]);
            }else{
                return redirect('rekapjurnalguru/view')->with(['failed' => 'Data tidak ditemukan!']);
            }
        }else
        {
            return redirect('rekapjurnalguru/view')->with(['failed' => 'Data tidak ditemukan!']);
        }
    }
}