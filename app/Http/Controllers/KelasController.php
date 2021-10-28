<?php

namespace App\Http\Controllers;

use App\DataKelasModel;
use App\DataSiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\KelasExport;
use App\Imports\KelasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DataKelasModel::paginate(10);

        return view('pages.data_kelas.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = DB::table('kelas')
                ->rightJoin('siswa', 'kelas.Id_Kelas', '=', 'siswa.Id_Kelas')
                ->get();

        return view('pages.data_kelas.create', ['create' => $create]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $loop = $request->get('list_siswa');

        if($loop != null){
            foreach($loop as $id_siswa){
                // INPUT TABEL SISWA //
                $kelas = DB::table('kelas')
                        ->where('Tingkat_Kelas', '=', $request->tingkat_kelas)
                        ->where('Jurusan', '=', $request->jurusan)
                        ->where('Nomor_Kelas', '=', $request->nomor_kelas)
                        ->get();
    
                foreach($kelas as $id){
                    DB::table('siswa')
                    ->where('Id_Siswa', '=', $id_siswa)
                    ->update([
                        'Id_Kelas' => $id->Id_Kelas
                    ]);
                }
            }
        }else{
            return back()->with(['failed' => 'Data siswa belum dipilih!']);
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
        $edit = DB::table('kelas')
                ->rightJoin('siswa', 'kelas.Id_Kelas', '=', 'siswa.Id_Kelas')
                ->where('kelas.Id_Kelas', '=', $id)
                ->get();
        
        if(count($edit) == 0){
            return back()->with(['failed' => 'Data siswa tidak ditemukan! Silahkan tambahkan terlebih dahulu!']);
        }else{
            return view('pages.data_kelas.edit', ['edit' => $edit]);
        }
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
        $loop = $request->get('list_siswa');
        
        if($loop != null){
            foreach($loop as $id_siswa){
                // INPUT TABEL SISWA //
                $kelas = DB::table('kelas')
                        ->where('Tingkat_Kelas', '=', $request->tingkat_kelas)
                        ->where('Jurusan', '=', $request->jurusan)
                        ->where('Nomor_Kelas', '=', $request->nomor_kelas)
                        ->get();
    
                foreach($kelas as $id){
                    DB::table('siswa')
                    ->where('Id_Siswa', '=', $id_siswa)
                    ->update([
                        'Id_Kelas' => $id->Id_Kelas
                    ]);
                }
            }
        }else{
            return back()->with(['failed' => 'Data siswa belum dipilih!']);
        }
        
        return redirect('kelas/view')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = DB::table('siswa')
                    ->where('Id_Kelas', '=', $id)
                    ->get();

        foreach($siswa as $siswas){
            DB::table('siswa')
                ->where('Id_Siswa','=', $siswas->Id_Siswa)
                ->delete();
        }

        return back()->with(['success' => 'Data berhasil dihapus!']);
    }

    public function import_excel(Request $request) 
	{
        // validasi
		//$this->validate($request, [
		//	'dataSiswa' => 'required|file|mimes:csv,xls,xlsx'
		//]);

		// menangkap file excel
		$file = $request->file('dataKelas');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
        
		// upload ke folder file_kelas di dalam folder public
		$file->move('file_kelas',$nama_file);

		// import data
		Excel::import(new KelasImport, public_path('/file_kelas/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('kelas/view')->with(['success' => 'Data berhasil dimport!']);
    }
    
    public function export_excel()
	{
		return Excel::download(new KelasExport, 'kelas.xlsx');
	}
}