<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FreshDataExport;
use App\Http\Controllers\Controller;
use App\Imports\NumberImport;
use App\Models\Duplicate;
use App\Models\FreshData;
use App\Models\TotalData;
use Illuminate\Http\Request;
use Excel;
use Session;

class DataController extends Controller
{
    public function total()
    {
        $total_data = TotalData::get();
        return view('admin.total-data.list')->with(compact('total_data'));
    }

    public function fresh()
    {
        $fresh_data = FreshData::get();
        $duplicate_data = Duplicate::get();
        return view('admin.fresh-data.list')->with(compact('fresh_data','duplicate_data'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx'
        ]);

        $count = FreshData::count();
        $countDuplicate = Duplicate::count();
        if($count > 0){
            FreshData::truncate();
        }
        if($countDuplicate > 0){
            Duplicate::truncate();
        }

        Excel::import(new NumberImport, $request->file('excel')->store('temp'));
        return back()->with('success', 'Data imported successfully.');
    }

    public function export()
    {
        // $count = FreshData::count();
        // $countDuplicate = Duplicate::count();
        // if($count == 0){
        //     return redirect()->back()->with('error', 'Please import data first.');
        // }
        // // merge fresh data with total data
        // $fresh_data = FreshData::get();
        // foreach ($fresh_data as $key => $value) {
        //     $total_data = new TotalData();
        //     $total_data->number = $value->number;
        //     $total_data->save();
        // }
        
        // // delete all data in fresh_data table and duplicate table
        
        // if($count > 0){
        //     FreshData::truncate();
        // }
        // if($countDuplicate > 0){
        //     Duplicate::truncate();
        // }
        // random file name genararate for excel file
        $random = rand(100000, 999999);
        $fileName = 'fresh_data_'.$random.'.xlsx';
         Excel::store(new FreshDataExport, $fileName);
         return response()->json(['file' => $fileName]);
    }
}
