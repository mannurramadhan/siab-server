<?php

namespace App\Imports;

use App\DataMataPelajaranModel;
use Maatwebsite\Excel\Concerns\ToModel;

class MapelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataMataPelajaranModel([
            'Id_Guru' => $row[1], 
            'Nama_Mapel' => $row[2], 
            'Guru_Pengampu' => $row[3], 
            'Kelas_Mapel' => $row[4], 
            'Jenis_Kelas' => $row[5]
        ]);
    }
}
