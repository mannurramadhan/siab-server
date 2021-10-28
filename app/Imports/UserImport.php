<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nama' => $row[3],
            'nip_niph' => $row[1],
            'jabatan' => $row[5],
            'foto' => $row[6],
            'email' => $row[7],
            'password' => Hash::make($row[8]),
        ]);
    }
}
