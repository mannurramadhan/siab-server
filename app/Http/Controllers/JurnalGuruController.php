<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JurnalGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $namaGuru = Auth::user()->nama;
        $guru = DB::table('guru')->where('Nama_Lengkap', '=', $namaGuru)->first();

        $index = DB::table('jurnalguru')->where('Id_Guru', '=', $guru->Id_Guru)->paginate(10);

        return view('pages.data_jurnal_guru.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kelas = DB::table('kelas')
                    ->where('Id_Kelas', '=', $id)
                    ->first();

        $kelas_mapel = $kelas->Tingkat_Kelas.' '.$kelas->Jurusan.' '.$kelas->Nomor_Kelas;

        $guru = Auth::user()->nama;

        $mapel = DB::table('matapelajaran')
                    ->where('Kelas_Mapel', '=', $kelas_mapel)
                    ->where('Guru_Pengampu', '=', $guru)
                    ->first();
        
        return view('pages.data_jurnal_guru.create', compact('mapel', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guru = DB::table('guru')
                ->where('Nama_Lengkap', '=', $request->guru_pengampu)
                ->first();

        DB::table('jurnalguru')
            ->insert([
                'Id_Guru' => $guru->Id_Guru,
                'Id_Kelas' => $request->id_kelas,
                'Id_Mapel' => $request->id_mapel,
                'Hari' => $request->hari,
                'Tanggal' => $request->tanggal,
                'Sesi' => $request->sesi,
                'Materi_Mapel' => $request->materi_mapel
            ]);
        
        $getlast = DB::table('jurnalguru')->get()->last();
        
        DB::table('rekapjurnalguru')
            ->insert([
                'Id_Jurnal_Guru' => $getlast->Id_Jurnal_Guru,
                'Id_Guru' => $guru->Id_Guru,
                'Id_Kelas' => $request->id_kelas,
                'Id_Mapel' => $request->id_mapel,
                'Bulan' => $request->tanggal,
                'Tahun' => $request->tanggal
            ]);
        
        return redirect('jurnalguru/view')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = DB::table('jurnalguru')
                ->where('Id_Jurnal_Guru','=',$id)
                ->get();

        return view('pages.data_jurnal_guru.edit', ['edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('jurnalguru')
            ->where('Id_Jurnal_Guru', '=', $request->id_jurnal_guru)
            ->update([
                'Hari' => $request->hari,
                'Tanggal' => $request->tanggal,
                'Sesi' => $request->sesi,
                'Materi_Mapel' => $request->materi_mapel
            ]);
        
        DB::table('rekapjurnalguru')
            ->where('Id_Jurnal_Guru', '=', $request->id_jurnal_guru)
            ->update([
                'Bulan' => $request->tanggal,
                'Tahun' => $request->tanggal
            ]);

        return redirect('jurnalguru/view')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = DB::table('jurnalguru')
                ->where('Id_Jurnal_Guru', '=', $id)
                ->get();

        return view('pages.data_jurnal_guru.show', ['show' => $show]);
    }

    /**
     * Display the classes options.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kelas()
    {
        $guru = Auth::user()->nama;

        $kelas = DB::table('matapelajaran')
                ->where('Guru_Pengampu', '=', $guru)
                ->get();

        return view('pages.data_jurnal_guru.kelas', ['kelas' => $kelas]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprint()
    {
        $namaGuru = Auth::user()->nama;
        $guru = DB::table('guru')->where('Nama_Lengkap', '=', $namaGuru)->first();
        $indexprint = DB::table('jurnalguru')->where('Id_Guru', '=', $guru->Id_Guru)->paginate(10);

        $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM jurnalguru WHERE Id_Guru = $guru->Id_Guru");
        $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM jurnalguru WHERE Id_Guru = $guru->Id_Guru");

        return view('pages.data_jurnal_guru.indexprint', compact('indexprint', 'kelas', 'mapel'));
    }

    /**
     * Show the form for filtering the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterprint(Request $request)
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
            $namaGuru = Auth::user()->nama;
            $guru = DB::table('guru')->where('Nama_Lengkap', '=', $namaGuru)->first();
            $index = DB::table('rekapjurnalguru')
                    ->where('Id_Kelas', '=', $id1)
                    ->where('Id_Mapel', '=', $idMapel->Id_Mapel)
                    ->where('Id_Guru', '=', $guru->Id_Guru)
                    ->paginate(10);

            $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM jurnalguru WHERE Id_Guru = $guru->Id_Guru");
            $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM jurnalguru WHERE Id_Guru = $guru->Id_Guru");
            
            // mengirim data ke view index
            return view('pages.data_jurnal_guru.filterprint', compact('index', 'kelas', 'mapel', 'id1', 'id2'));
        }else{
            return redirect('jurnalguru/viewprint')->with(['failed' => 'Data tidak ditemukan! Mungkin Anda salah input.']);
        }
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
            $index = DB::table('siswa')->where('Id_Kelas', '=', $id1)->get();
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
                return view('pages.rekapan_jurnal_guru.print', ['index'=>$index, 'id1'=>$id1, 'id2'=>$getMapel, 'get'=>$get]);
            }else{
                return redirect('jurnalguru/viewprint')->with(['failed' => 'Data tidak ditemukan!']);
            }
        }else
        {
            return redirect('jurnalguru/viewprint')->with(['failed' => 'Data tidak ditemukan!']);
        }
    }
}
