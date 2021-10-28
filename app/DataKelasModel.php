<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKelasModel extends Model
{
    protected $primaryKey = 'Id_Kelas';

    protected $table = "kelas";

    protected $fillable = [
        'Id_Kelas', 'Tingkat_Kelas', 'Jurusan', 'Nomor_Kelas', 'created at', 'updated at'
    ];

    public function rekapjurnalguru(){
        return $this->belongsTo('App\RekapJurnalGuruModel', 'Id_Rekap_Jurnal_Guru');
    }
    public function rekapabsensi(){
        return $this->belongsTo('App\RekapAbsensiModel', 'Id_Rekap_Absen');
    }
    public function siswa(){
        return $this->belongsTo('App\DataSiswaModel', 'Id_Siswa');
    }
    public function absen(){
        return $this->belongsTo('App\DataAbsenModel', 'Id_Absen');
    }
    public function jurnalguru(){
        return $this->belongsTo('App\DataJurnalGuruModel', 'Id_Jurnal_Guru');
    }
}
