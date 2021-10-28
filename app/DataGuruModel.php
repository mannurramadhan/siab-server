<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataGuruModel extends Model
{
    protected $primaryKey = 'Id_Guru';

    protected $table = "guru";

    protected $fillable = [
        'Id_Guru', 'NIP', 'NIPH', 'Nama_Lengkap', 'Jenis_Kelamin', 'created at', 'updated at'
    ];
    
    public function jurnalguru(){
        return $this->belongsTo('App\DataJurnalGuruModel', 'Id_Jurnal_Guru');
    }
    public function absen(){
        return $this->belongsTo('App\DataAbsenModel', 'Id_Absen');
    }
    public function mapel(){
        return $this->belongsTo('App\DataMataPelajaranModel', 'Id_Mapel');
    }
    public function rekapabsensi(){
        return $this->belongsTo('App\RekapAbsensiModel', 'Id_Rekap_Absen');
    }
    public function rekapjurnalguru(){
        return $this->belongsTo('App\RekapAbsensiModel', 'Id_Rekap_Jurnal_Guru');
    }
}
