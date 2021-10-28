<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DB::table('guru')->paginate(10);

        return view('pages.data_guru.index', ['index' => $index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data_guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('guru')
            ->insert([
                'NIP' => $request->nip,
                'NIPH' => $request->niph,
                'Nama_Lengkap' => $request->nama_guru,
                'Jenis_Kelamin' => $request->jenis_kelamin,
                'Tanggal_Lahir' => $request->tanggal_lahir
            ]);
        
        if ($request->nip != 0) {
            $nip_niph = $request->nip;
        } else {
            $nip_niph = $request->niph;
        }

        //Password Default
        $tglLahir = $request->tanggal_lahir;
        
        $password = $tglLahir;
        
        DB::table('users')
            ->insert([
                'nama' => $request->nama_guru,
                'nip_niph' => $nip_niph,
                'jabatan' => $request->jabatan,
                'foto' => $request->foto,
                'email' => $request->email,
                'password' => Hash::make($password)
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
        $edit = DB::table('guru')
                ->where('Id_Guru','=', $id)
                ->get();

        return view('pages.data_guru.edit', ['edit' => $edit]);
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
        DB::table('guru')
            ->where('Id_Guru', '=', $request->id_guru)
            ->update([
                'NIP' => $request->nip,
                'NIPH' => $request->niph,
                'Nama_Lengkap' => $request->nama_guru,
                'Jenis_Kelamin' => $request->jenis_kelamin,
                'Tanggal_Lahir' => $request->tanggal_lahir
            ]);
        
        if ($request->nip != 0) {
            $nip_niph = $request->nip;
        } else {
            $nip_niph = $request->niph;
        }

        DB::table('users')
            ->where('id', '=', ($request->id_guru + 1))
            ->update([
                'nama' => $request->nama_guru,
                'nip_niph' => $nip_niph
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
        DB::table('guru')
            ->where('Id_Guru','=',$id)
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
		$file = $request->file('dataGuru');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
        
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_guru',$nama_file);

		// import data
        Excel::import(new GuruImport, public_path('/file_guru/'.$nama_file));
        Excel::import(new UserImport, public_path('/file_guru/'.$nama_file));

		// alihkan halaman kembali
		return redirect('guru/view')->with(['success' => 'Data berhasil dimport!']);
    }
    
    public function export_excel()
	{
		return Excel::download(new GuruExport, 'guru.xlsx');
	}
}
