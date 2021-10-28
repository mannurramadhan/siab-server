<?php

namespace App\Imports;

use App\DataSiswaModel;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataSiswaModel([
            'Id_Kelas' => $row[1], 
            'NIS' => $row[2], 
            'NISN' => $row[3], 
            'Nama_Siswa' => $row[4], 
            'Jenis_Kelamin' => $row[5]
        ]);
    }
}
