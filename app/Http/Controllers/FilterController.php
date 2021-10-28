<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /**
     * Show the form for filtering the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterabsensi(Request $request)
    {
        // menangkap data pencarian
        $id1 = $request->id1; //id kelas
        $id2 = $request->id2; //nama mapel
        
        $cariKelas = DB::table('kelas')->where('Id_Kelas', '=', $id1)->first();
        $namaKelas = $cariKelas->Tingkat_Kelas.' '.$cariKelas->Jurusan.' '.$cariKelas->Nomor_Kelas;
        $idMapel = DB::table('matapelajaran')
                    ->where('Nama_Mapel', '=', $id2)
                    ->where('Kelas_Mapel', '=', $namaKelas)
                    ->first();
        
        if($idMapel != null){
            // mengambil data dari table sesuai pencarian data
            $index = DB::table('rekapabsensisiswa')
                    ->where('Id_Kelas', '=', $id1)
                    ->where('Id_Mapel', '=', $idMapel->Id_Mapel)
                    ->paginate(10);

            $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM rekapabsensisiswa");
            $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM rekapabsensisiswa");
                                    
            // mengirim data ke view filter
            return view('pages.rekapan_absensi.filter', compact('index', 'kelas', 'mapel', 'id1', 'id2'));
        }else{
            return redirect('rekapabsensi/view')->with(['failed' => 'Data tidak ditemukan! Mungkin Anda salah input.']);
        }
    }

    /**
     * Show the form for filtering the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterjurnalguru(Request $request)
    {
        // menangkap data pencarian
        $id1 = $request->id1; //id kelas
        $id2 = $request->id2; //nama mapel

        $cariKelas = DB::table('kelas')->where('Id_Kelas', '=', $id1)->first();
        $namaKelas = $cariKelas->Tingkat_Kelas.' '.$cariKelas->Jurusan.' '.$cariKelas->Nomor_Kelas;
        $idMapel = DB::table('matapelajaran')
                    ->where('Nama_Mapel', '=', $id2)
                    ->where('Kelas_Mapel', '=', $namaKelas)
                    ->first();

        if($idMapel != null){
            // mengambil data dari table sesuai pencarian data
            $index = DB::table('rekapjurnalguru')
                    ->where('Id_Kelas', '=', $id1)
                    ->where('Id_Mapel', '=', $idMapel->Id_Mapel)
                    ->paginate(10);

            $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM rekapjurnalguru");
            $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM rekapjurnalguru");
            
            // mengirim data ke view filter
            return view('pages.rekapan_jurnal_guru.filter', compact('index', 'kelas', 'mapel', 'id1', 'id2'));
        }else{
            return redirect('rekapjurnalguru/view')->with(['failed' => 'Data tidak ditemukan! Mungkin Anda salah input.']);
        }
        
    }
}
