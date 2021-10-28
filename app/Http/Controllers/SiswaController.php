<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DB::table('siswa')->paginate(10);

        return view('pages.data_siswa.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data_siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('siswa')
            ->insert([
                'Id_Kelas' => NULL,
                'NIS' => $request->nis,
                'NISN' => $request->nisn,
                'Nama_Siswa' => $request->nama_siswa,
                'Jenis_Kelamin' => $request->jenis_kelamin
            ]);
        
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
        $edit = DB::table('siswa')
                ->where('Id_Siswa','=',$id)
                ->get();

        return view('pages.data_siswa.edit', ['edit' => $edit]);
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
        DB::table('siswa')
            ->where('Id_Siswa', '=', $request->id_siswa)
            ->update([
                'NIS' => $request->nis,
                'NISN' => $request->nisn,
                'Nama_Siswa' => $request->nama_siswa,
                'Jenis_Kelamin' => $request->jenis_kelamin
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
        DB::table('siswa')
            ->where('Id_Siswa','=',$id)
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
		$file = $request->file('dataSiswa');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
        
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa',$nama_file);

		// import data
		Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('siswa/view')->with(['success' => 'Data berhasil dimport!']);
    }
    
    public function export_excel()
	{
		return Excel::download(new SiswaExport, 'siswa.xlsx');
	}
}
