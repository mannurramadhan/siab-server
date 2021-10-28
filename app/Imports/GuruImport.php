<?php

namespace App\Imports;

use App\DataGuruModel;
use Maatwebsite\Excel\Concerns\ToModel;

class GuruImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataGuruModel([
            'NIP' => $row[1], 
            'NIPH' => $row[2], 
            'Nama_Lengkap' => $row[3], 
            'Jenis_Kelamin' => $row[4]
        ]);
    }
}
