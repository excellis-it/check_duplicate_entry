<?php

namespace App\Imports;

use App\Models\Duplicate;
use App\Models\FreshData;
use App\Models\TotalData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NumberImport implements ToCollection, WithHeadingRow, WithChunkReading ,ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     // add validator here
    //      $validator = Validator::make($row, [
    //         'number' => 'required',
    //     ]);
        
    //     $total_data = TotalData::where('number', $row[0])->first();
    //     if ($total_data) {
    //         $duplicate = new Duplicate();
    //         $duplicate->number = $row[0];
    //         $duplicate->save();
    //     } else {
    //         $fresh_data = new FreshData();
    //         $fresh_data->number = $row[0];
    //         $fresh_data->save();
    //     }
    // }

    public function collection(Collection $rows)
    {
        // check the header of the excel
        // dd($rows[0]['number']);
         
        if (isset($rows[0]['number'])) {
            $validator = Validator::make($rows->toArray(), [
                '*.number' => 'required',
            ]);
    
            foreach ($rows as $row) {
                $total_data = TotalData::where('number', $row['number'])->first();
                if ($total_data) {
                    $duplicate = new Duplicate();
                    $duplicate->number = $row['number'];
                    $duplicate->save();
                } else {
                    $fresh_data = new FreshData();
                    $fresh_data->number = $row['number'];
                    $fresh_data->save();
                }
            } 
            Session::flash('success', 'Data imported successfully.');
        }
         else {
            Session::flash('error', 'Please add a header. The header should be "number"');
        }
       
    }


    public function chunkSize(): int
    {
        return 1000;
    }
}
