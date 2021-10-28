<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAbsenModel extends Model
{
    protected $primaryKey = 'Id_Absen';

    protected $table = "absensi";

    protected $fillable = [
        'Id_Absen', 'Id_Kelas', 'Id_Mapel', 'Id_Guru', 'Hari', 'Tanggal', 'Sesi', 
        'Hadir', 'Izin', 'Sakit', 'Alpa', 'created_at', 'updated_at'
    ];

    public function rekapabsensi(){
        return $this->belongsTo('App\RekapAbsensiModel', 'Id_Rekap_Absen');
    }
    public function kelas(){
        return $this->hasMany('App\DataKelasModel','Id_Kelas');
    }
    public function mapel(){
        return $this->hasMany('App\DataMataPelajaranModel','Id_Mapel');
    }
    public function guru(){
        return $this->hasMany('App\DataGuruModel','Id_Guru');
    }
}
