<?php

namespace App\Exports;

use App\DataSiswaModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataSiswaModel::all();
    }
}
