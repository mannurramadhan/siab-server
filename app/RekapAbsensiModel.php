<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapAbsensiModel extends Model
{
    protected $primaryKey = 'Id_Rekap_Absen';

    protected $table = "absensi";

    protected $fillable = [
        'Id_Rekap_Absen', 'Id_Absen', 'Id_Kelas', 'Id_Mapel', 'Id_Guru', 'Bulan', 'Tahun', 
        'Hadir', 'Izin', 'Sakit', 'Alpa', 'created_at', 'updated_at'
    ];

    public function absen(){
        return $this->hasMany('App\DataAbsenModel', 'Id_Absen');
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
