<?php

namespace App\Exports;

use App\DataGuruModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuruExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataGuruModel::all();
    }
}
