<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataJurnalGuruModel extends Model
{
    protected $primaryKey = 'Id_Jurnal_Guru';

    protected $table = "jurnalguru";

    protected $fillable = [
        'Id_Jurnal_Guru', 'Id_Kelas', 'Id_Mapel', 'Id_Guru', 'Hari', 'Tanggal', 'Sesi', 'Materi_Mapel',
        'created_at', 'updated_at'
    ];

    public function rekapjurnalguru(){
        return $this->belongsTo('App\RekapJurnalGuruModel', 'Id_Rekap_Jurnal_Guru');
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
