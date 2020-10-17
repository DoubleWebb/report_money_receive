<?php

namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('page\dashboard');
    }
}
