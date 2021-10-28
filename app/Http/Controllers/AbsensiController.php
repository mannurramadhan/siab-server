<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AbsensiController extends Controller
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

        $index = DB::table('absensi')->where('Id_Guru', '=', $guru->Id_Guru)->paginate(10);

        return view('pages.data_absensi.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $siswa = DB::table('kelas')
                ->rightJoin('siswa', 'kelas.Id_Kelas', '=', 'siswa.Id_Kelas')
                ->where('siswa.Id_Kelas', '=', $id)
                ->get();
        
        foreach($siswa as $siswas){
            $kelas_siswa = $siswas->Tingkat_Kelas.' '.$siswas->Jurusan.' '.$siswas->Nomor_Kelas;
            $guru = Auth::user()->nama;
            $mapel = DB::table('matapelajaran')
                        ->where('Kelas_Mapel', '=', $kelas_siswa)
                        ->where('Guru_Pengampu', '=', $guru)
                        ->first();
        }

        return view('pages.data_absensi.create', compact('siswa', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get = DB::table('kelas')
                ->rightJoin('siswa', 'kelas.Id_Kelas', '=', 'siswa.Id_Kelas')
                ->where('siswa.Id_Kelas', '=', $request->id_kelas)
                ->get();

        foreach($get as $gets){
            $kelas = DB::table('kelas')
                    ->where('Tingkat_Kelas', '=', $gets->Tingkat_Kelas)
                    ->where('Jurusan', '=', $gets->Jurusan)
                    ->where('Nomor_Kelas', '=', $gets->Nomor_Kelas)
                    ->first();
        }

        $guru = DB::table('guru')
                ->where('Nama_Lengkap', '=', $request->guru_pengampu)
                ->first();

        $hadir = serialize($request->get('hadir'));
        $sakit = serialize($request->get('sakit'));
        $izin = serialize($request->get('izin'));
        $alpa = serialize($request->get('alpa'));
        
        DB::table('absensi')
            ->insert([
                'Id_Guru' => $guru->Id_Guru,
                'Id_Mapel' => $request->id_mapel,
                'Id_Kelas' => $kelas->Id_Kelas,
                'Hari' => $request->hari,
                'Tanggal' => $request->tanggal,
                'Sesi' => $request->sesi,
                'Hadir' => $hadir,
                'Izin' => $izin,
                'Sakit' => $sakit,
                'Alpa' => $alpa
            ]);

        $getlast = DB::table('absensi')->get()->last();

        DB::table('rekapabsensisiswa')
            ->insert([
                'Id_Absen' => $getlast->Id_Absen,
                'Id_Kelas' => $request->id_kelas,
                'Id_Mapel' => $request->id_mapel,
                'Id_Guru' => $guru->Id_Guru,
                'Bulan' => $request->tanggal,
                'Tahun' => $request->tanggal,
                'Hadir' => $hadir,
                'Izin' => $izin,
                'Sakit' => $sakit,
                'Alpa' => $alpa
            ]);
        
        return redirect('absensi/view')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absen = DB::table('absensi')
                ->where('Id_Absen', '=', $id)
                ->first();
        
        $siswa = DB::table('kelas')
                ->rightJoin('siswa', 'kelas.Id_Kelas', '=', 'siswa.Id_Kelas')
                ->where('siswa.Id_Kelas', '=', $absen->Id_Kelas)
                ->get();
        
        $kelas = DB::table('kelas')
                ->where('Id_Kelas', '=', $absen->Id_Kelas)
                ->first();
        
        $guru = DB::table('guru')
                ->where('Id_Guru', '=', $absen->Id_Guru)
                ->first();

        $mapel = DB::table('matapelajaran')
                ->where('Id_Mapel', '=', $absen->Id_Mapel)
                ->where('Guru_Pengampu', '=', $guru->Nama_Lengkap)
                ->first();

        return view('pages.data_absensi.show', compact('absen', 'siswa', 'mapel'));   
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
        
        return view('pages.data_absensi.kelas', ['kelas' => $kelas]);
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
        $indexprint = DB::table('absensi')->where('Id_Guru', '=', $guru->Id_Guru)->paginate(10);
        
        $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM absensi WHERE Id_Guru = $guru->Id_Guru");
        $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM absensi WHERE Id_Guru = $guru->Id_Guru");

        return view('pages.data_absensi.indexprint', compact('indexprint', 'kelas', 'mapel'));
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
            $index = DB::table('rekapabsensisiswa')
                    ->where('Id_Kelas', '=', $id1)
                    ->where('Id_Mapel', '=', $idMapel->Id_Mapel)
                    ->where('Id_Guru', '=', $guru->Id_Guru)
                    ->paginate(10);

            $kelas = DB::select("SELECT DISTINCT Id_Kelas FROM absensi WHERE Id_Guru = $guru->Id_Guru");
            $mapel = DB::select("SELECT DISTINCT Id_Mapel FROM absensi WHERE Id_Guru = $guru->Id_Guru");
            
            // mengirim data ke view index
            return view('pages.data_absensi.filterprint', compact('index', 'kelas', 'mapel', 'id1', 'id2'));
        }else{
            return redirect('absensi/viewprint')->with(['failed' => 'Data tidak ditemukan! Mungkin Anda salah input.']);
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

            $get = DB::table('absensi')
                        ->where('Id_Kelas', '=', $id1)
                        ->where('Id_Mapel', '=', $getMapel->Id_Mapel)
                        ->first();

            if($get != null){
                return view('pages.rekapan_absensi.print', ['index'=>$index, 'id1'=>$id1, 'id2'=>$getMapel, 'get'=>$get]);
                //$pdf = PDF::loadview('pages.rekapan_absensi.print',['index'=>$index, 'id1'=>$id1, 'id2'=>$getMapel, 'get'=>$get]);
                //return $pdf->download('laporan-absensi-siswa');
                //return $pdf->stream();
            }else{
                return redirect('absensi/viewprint')->with(['failed' => 'Data tidak ditemukan!']);
            }
        }else
        {
            return redirect('absensi/viewprint')->with(['failed' => 'Data tidak ditemukan!']);
        }
    }
}