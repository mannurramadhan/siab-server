<?php

namespace App\Http\Controllers;

use App\User;
use App\DataAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama = Auth::user()->nama_admin;
        $admin = DataAdminModel::where('nama_admin', '=', $nama)->first();

        return view('pages.profil_admin.index', ['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = DataAdminModel::where('id_admin', '=', $id)->first();

        return view('pages.profil_admin.edit', ['admin' => $admin]);
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
        $this->validate($request, [
			'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		]);
 
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('foto');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'images/foto';
		$file->move($tujuan_upload,$nama_file);

        DB::table('admin')
            ->where('id_admin', '=', $request->id)
            ->update([
                'nama_admin' => $request->nama_admin,
                'foto' => $nama_file,
            ]);

        return redirect('profil-admin/view')->with(['success' => 'Data berhasil disimpan!']);
    }
}
