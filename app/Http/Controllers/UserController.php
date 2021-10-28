<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    //public function index(User $model)
    //{
    //    return view('users.index', ['users' => $model->paginate(15)]);
    //}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = DB::table('users')->where('jabatan', '=', "Guru")->paginate(10);

        return view('pages.data_user.index', ['index' => $index]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //Password Default
        $getGuru = DB::table('guru')->where('id', '=', $id)->first();

        $password = $getGuru->Tanggal_Lahir;
        
        DB::table('users')
            ->where('id', '=', $id)
            ->update([
                'password' => Hash::make($password)
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
        DB::table('users')
            ->where('id','=', $id)
            ->delete();
        
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
