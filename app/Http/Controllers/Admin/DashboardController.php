<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreshData;
use App\Models\TotalData;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count['fresh_data'] = FreshData::count();
        $count['total_data'] = TotalData::count();
        return view('admin.dashboard')->with(compact('count'));
    }

}
