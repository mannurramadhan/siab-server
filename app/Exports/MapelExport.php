<?php

namespace App\Exports;

use App\DataMataPelajaranModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class MapelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataMataPelajaranModel::all();
    }
}
