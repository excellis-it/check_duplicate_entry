<?php

namespace App\Imports;

use App\Models\Duplicate;
use App\Models\FreshData;
use App\Models\TotalData;
use Maatwebsite\Excel\Concerns\ToModel;

class NumberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // compare data with TotalData table and all data import in Duplicate table
        // dd($row);
       
        $total_data = TotalData::where('number', $row[0])->first();
        if ($total_data) {
            $duplicate = new Duplicate();
            $duplicate->number = $row[0];
            $duplicate->save();
        } else {
            $fresh_data = new FreshData();
            $fresh_data->number = $row[0];
            $fresh_data->save();
        }
    }
}
