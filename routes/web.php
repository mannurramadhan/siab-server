<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile/edit', ['as' => 'edit.profile', 'uses' => 'ProfileController@edit']);
	Route::put('profile/update', ['as' => 'update.profile', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'password.profile', 'uses' => 'ProfileController@password']);
});

//Route::group(['middleware' => 'auth'], function () {
	//Route::resource('user', 'UserController', ['except' => ['show']]);
	//Route::get('profile/edit', 'ProfilController@edit')->name('edit.profile');
	//Route::put('profile/update', 'ProfilController@update')->name('update.profile');
	//Route::put('profile/password', 'ProfileController@password')->name('password.profile');
//});

Route::group(['middleware' => 'auth'], function () {
	Route::get('rekapabsensisiswa/view', 'RekapAbsensiController@index')->name('view.ras');
	Route::get('rekapabsensisiswa/cetak', 'RekapAbsensiController@print')->name('print.ras');
	Route::get('rekapabsensisiswa/cari','FilterController@filterabsensi')->name('filter.ras');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('rekapjurnalguru/view', 'RekapJurnalGuruController@index')->name('view.rba');
	Route::get('rekapjurnalguru/cetak', 'RekapJurnalGuruController@print')->name('print.rba');
	Route::get('rekapjurnalguru/cari','FilterController@filterjurnalguru')->name('filter.rba');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('absensi/view', 'AbsensiController@index')->name('view.absensi');
	Route::get('absensi/kelas', 'AbsensiController@kelas')->name('kelas.absensi');
	Route::get('absensi/create/{id}', 'AbsensiController@create')->name('create.absensi');
	Route::post('absensi/store', 'AbsensiController@store')->name('store.absensi');
	Route::get('absensi/show/{id}', 'AbsensiController@show')->name('show.absensi');
	Route::get('absensi/edit/{id}', 'AbsensiController@edit')->name('edit.absensi');
	Route::post('absensi/update', 'AbsensiController@update')->name('update.absensi');
	Route::get('absensi/delete/{id}', 'AbsensiController@destroy')->name('destroy.absensi');
	Route::get('absensi/viewprint', 'AbsensiController@indexprint')->name('viewprint.absensi');
	Route::get('absensi/cari','AbsensiController@filterprint')->name('filterprint.absensi');
	Route::get('absensi/cetak','AbsensiController@print')->name('print.absensi');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('jurnalguru/view', 'JurnalGuruController@index')->name('view.jurnalguru');
	Route::get('jurnalguru/kelas', 'JurnalGuruController@kelas')->name('kelas.jurnalguru');
	Route::get('jurnalguru/create/{id}', 'JurnalGuruController@create')->name('create.jurnalguru');
	Route::post('jurnalguru/store', 'JurnalGuruController@store')->name('store.jurnalguru');
	Route::get('jurnalguru/show/{id}', 'JurnalGuruController@show')->name('show.jurnalguru');
	Route::get('jurnalguru/edit/{id}', 'JurnalGuruController@edit')->name('edit.jurnalguru');
	Route::post('jurnalguru/update', 'JurnalGuruController@update')->name('update.jurnalguru');
	Route::get('jurnalguru/delete/{id}', 'JurnalGuruController@destroy')->name('destroy.jurnalguru');
	Route::get('jurnalguru/viewprint', 'JurnalGuruController@indexprint')->name('viewprint.jurnalguru');
	Route::get('jurnalguru/cari','JurnalGuruController@filterprint')->name('filterprint.jurnalguru');
	Route::get('jurnalguru/cetak','JurnalGuruController@print')->name('print.jurnalguru');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('guru/view', 'GuruController@index')->name('view.guru');
	Route::get('guru/create', 'GuruController@create')->name('create.guru');
	Route::post('guru/store', 'GuruController@store')->name('store.guru');
	Route::get('guru/edit/{id}', 'GuruController@edit')->name('edit.guru');
	Route::post('guru/update', 'GuruController@update')->name('update.guru');
	Route::get('guru/delete/{id}', 'GuruController@destroy')->name('destroy.guru');
	Route::post('guru/import_excel', 'GuruController@import_excel')->name('import.guru');
	Route::get('guru/export_excel', 'GuruController@export_excel')->name('export.guru');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('siswa/view', 'SiswaController@index')->name('view.siswa');
	Route::get('siswa/create', 'SiswaController@create')->name('create.siswa');
	Route::post('siswa/store', 'SiswaController@store')->name('store.siswa');
	Route::get('siswa/edit/{id}', 'SiswaController@edit')->name('edit.siswa');
	Route::post('siswa/update', 'SiswaController@update')->name('update.siswa');
	Route::get('siswa/delete/{id}', 'SiswaController@destroy')->name('destroy.siswa');
	Route::post('siswa/import_excel', 'SiswaController@import_excel')->name('import.siswa');
	Route::get('siswa/export_excel', 'SiswaController@export_excel')->name('export.siswa');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('kelas/view', 'KelasController@index')->name('view.kelas');
	Route::get('kelas/create', 'KelasController@create')->name('create.kelas');
	Route::post('kelas/store', 'KelasController@store')->name('store.kelas');
	Route::get('kelas/edit/{id}', 'KelasController@edit')->name('edit.kelas');
	Route::post('kelas/update', 'KelasController@update')->name('update.kelas');
	Route::get('kelas/delete/{id}', 'KelasController@destroy')->name('destroy.kelas');
	Route::post('kelas/import_excel', 'KelasController@import_excel')->name('import.kelas');
	Route::get('kelas/export_excel', 'KelasController@export_excel')->name('export.kelas');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('mapel/view', 'MataPelajaranController@index')->name('view.mapel');
	Route::get('mapel/create', 'MataPelajaranController@create')->name('create.mapel');
	Route::post('mapel/store', 'MataPelajaranController@store')->name('store.mapel');
	Route::get('mapel/edit/{id}', 'MataPelajaranController@edit')->name('edit.mapel');
	Route::post('mapel/update', 'MataPelajaranController@update')->name('update.mapel');
	Route::get('mapel/delete/{id}', 'MataPelajaranController@destroy')->name('destroy.mapel');
	Route::post('mapel/import_excel', 'MataPelajaranController@import_excel')->name('import.mapel');
	Route::get('mapel/export_excel', 'MataPelajaranController@export_excel')->name('export.mapel');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('user/view', 'UserController@index')->name('view.user');
	Route::post('user/update/{id}', 'UserController@update')->name('update.user');
	Route::get('user/delete/{id}', 'UserController@destroy')->name('destroy.user');
});