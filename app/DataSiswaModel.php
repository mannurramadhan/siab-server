<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSiswaModel extends Model
{
    protected $primaryKey = 'Id_Siswa';

    protected $table = "siswa";

    protected $fillable = [
        'Id_Siswa', 'Id_Kelas', 'NIS', 'NISN', 'Nama_Siswa', 'Jenis_Kelamin', 'created at', 'updated at'
    ];

    public function kelas(){
        return $this->hasMany('App\DataKelasModel','Id_Kelas');
    }
}
