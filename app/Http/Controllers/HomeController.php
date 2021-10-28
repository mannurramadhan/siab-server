<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $siswa = DB::table('siswa')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $absensi = DB::table('absensi')->get();
        $jurnalguru = DB::table('jurnalguru')->get();
        $rekap = $absensi->count() + $jurnalguru->count();
        return view('pages.home', compact('siswa', 'kelas', 'guru', 'rekap'));
    }
}
