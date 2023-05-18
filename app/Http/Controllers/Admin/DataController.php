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
use Storage;

class DataController extends Controller
{
    public function total()
    {
        $total_data = TotalData::paginate(50);
        return view('admin.total-data.list')->with(compact('total_data'));
    }

    public function fresh()
    {
        // $fresh_data = FreshData::paginate(50);
        // $duplicate_data = Duplicate::paginate(50);
        // two pagination in one page
        $fresh_data = FreshData::paginate(50, ['*'], 'fresh_page');
        $duplicate_data = Duplicate::paginate(50, ['*'], 'duplicate_page');
        return view('admin.fresh-data.list')->with(compact('fresh_data', 'duplicate_data'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls',
        ]);

        $count = FreshData::count();
        $countDuplicate = Duplicate::count();
        if ($count > 0) {
            FreshData::truncate();
        }
        if ($countDuplicate > 0) {
            Duplicate::truncate();
        }

        // Excel::import(new NumberImport, $request->file('excel')->store('temp'));
        Excel::import(new NumberImport,request()->file('excel'));
        return back()->with('success', 'Data imported successfully.');
    }

    public function export()
    {
        // random file name genararate for excel file
        $random = rand(100000, 999999);
        $fileName = 'fresh_data_' . $random . '.xlsx';
        //  Excel::store(new FreshDataExport, $fileName);
        Excel::store(new FreshDataExport, $fileName, 'public');
        $filepath = Storage::url($fileName);


        $count = FreshData::count();
        $countDuplicate = Duplicate::count();
        if ($count == 0) {
            return response()->json(['error' => 'No data found.', 'status' => false]);
        }
        // merge fresh data with total data
        $fresh_data = FreshData::orderBy('id', 'asc')->take(50000)->get();
        foreach ($fresh_data as $key => $value) {
            // check if number is already exist in total data table
            $total_data = TotalData::where('number', $value->number)->first();
            if ($total_data) {
                $duplicate = new Duplicate();
                $duplicate->number = $value->number;
                $duplicate->save();
            } else {
                $total_data = new TotalData();
                $total_data->number = $value->number;
                $total_data->save();
            }
        }


        // delete all data in fresh_data table and duplicate table
        // delete 50000 data at a time
         FreshData::orderBy('id', 'asc')->take(50000)->delete();

        if ($count > 0) {
            FreshData::orderBy('id', 'asc')->take(50000)->delete();
        }
        if ($countDuplicate > 0) {
            Duplicate::truncate();
        }

        return response()->json(['file' => $fileName, 'path' => $filepath, 'status' => true]);
    }
}
