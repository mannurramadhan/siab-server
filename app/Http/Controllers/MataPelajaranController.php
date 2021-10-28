<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\MapelExport;
use App\Imports\MapelImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DB::table('matapelajaran')->paginate(10);

        return view('pages.data_mapel.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = DB::table('guru')->get();
        $kelas = DB::table('kelas')->get();

        return view('pages.data_mapel.create', compact('guru', 'kelas'));
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
            ->where('Id_Guru', '=', $request->guru_pengampu)
            ->get();

        foreach($guru as $g){
            DB::table('matapelajaran')
            ->insert([
                'Id_Guru' => $request->guru_pengampu,
                'Nama_Mapel' => $request->nama_mapel,
                'Guru_Pengampu' => $g->Nama_Lengkap,
                'Kelas_Mapel' => $request->kelas_mapel,
                'Jenis_Kelas' => $request->jenis_kelas
            ]);
        }    
        
        return back()->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = DB::table('matapelajaran')
                ->where('Id_Mapel','=',$id)
                ->get();

        $guru = DB::table('guru')->get();
        $kelas = DB::table('kelas')->get();

        return view('pages.data_mapel.edit', compact('edit', 'guru', 'kelas'));
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
        $guru = DB::table('guru')
            ->where('Nama_Lengkap', '=', $request->guru_pengampu)
            ->first();

        DB::table('matapelajaran')
            ->where('Id_Mapel', '=', $request->id_mapel)
            ->update([
                'Id_Guru' => $guru->Id_Guru,
                'Nama_Mapel' => $request->nama_mapel,
                'Guru_Pengampu' => $guru->Nama_Lengkap,
                'Kelas_Mapel' => $request->kelas_mapel,
                'Jenis_Kelas' => $request->jenis_kelas
            ]);
        return back()->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('matapelajaran')
            ->where('Id_Mapel','=', $id)
            ->delete();
        
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }

    public function import_excel(Request $request) 
	{
        // validasi
		//$this->validate($request, [
		//	'dataSiswa' => 'required|file|mimes:csv,xls,xlsx'
		//]);

		// menangkap file excel
		$file = $request->file('dataMapel');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
        
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_mapel',$nama_file);

		// import data
		Excel::import(new MapelImport, public_path('/file_mapel/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('mapel/view')->with(['success' => 'Data berhasil dimport!']);
    }
    
    public function export_excel()
	{
		return Excel::download(new MapelExport, 'mapel.xlsx');
	}
}