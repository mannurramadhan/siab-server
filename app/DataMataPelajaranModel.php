<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMataPelajaranModel extends Model
{
    protected $primaryKey = 'Id_Mapel';

    protected $table = "matapelajaran";

    protected $fillable = [
        'Id_Mapel', 'Id_Guru', 'Nama_Mapel', 'Guru_Pengampu', 'Kelas_Mapel', 'Jenis_Kelas', 'created at', 'updated at'
    ];

    public function rekapjurnalguru(){
        return $this->belongsTo('App\RekapJurnalGuruModel', 'Id_Rekap_Jurnal_Guru');
    }
    public function rekapabsensi(){
        return $this->belongsTo('App\RekapAbsensiModel', 'Id_Rekap_Absen');
    }
    public function absen(){
        return $this->belongsTo('App\DataAbsenModel', 'Id_Absen');
    }
    public function jurnalguru(){
        return $this->belongsTo('App\DataJurnalGuruModel', 'Id_Jurnal_Guru');
    }
    public function guru(){
        return $this->hasMany('App\DataGuruModel','Id_Guru');
    }
}
