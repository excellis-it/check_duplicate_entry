<?php

namespace App\Exports;

use App\Models\FreshData;
use Maatwebsite\Excel\Concerns\FromCollection;

class FreshDataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FreshData::all();
    }
}
