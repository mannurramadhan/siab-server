<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapJurnalGuruModel extends Model
{
    protected $primaryKey = 'Id_Rekap_Jurnal_Guru';

    protected $table = "rekapjurnalguru";

    protected $fillable = [
        'Id_Rekap_Jurnal_Guru', 'Id_Jurnal_Guru', 'Id_Kelas', 'Id_Mapel', 'Id_Guru',
        'Bulan', 'Tahun', 'created_at', 'updated_at'
    ];

    public function jurnalguru(){
        return $this->hasMany('App\DataJurnalGuruModel','Id_Jurnal_Guru');
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
