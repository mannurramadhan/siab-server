<?php

namespace App\Imports;

use App\DataKelasModel;
use Maatwebsite\Excel\Concerns\ToModel;

class KelasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKelasModel([
            'Nomor_Kelas' => $row[1], 
            'Jurusan' => $row[2], 
            'Tingkat_Kelas' => $row[3]
        ]);
    }
}
