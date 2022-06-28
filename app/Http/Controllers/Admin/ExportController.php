<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CarPerformanceExport;
use App\Exports\PurchaseExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\OrderExport;

class ExportController extends Controller
{
    //
    public  function exportUsers()
    {
        return Excel::download(new UserExport, 'invoices.xlsx');
    }
    public function exportPurchases(){
        return Excel::download(new PurchaseExport, 'invoices.xlsx');

    }
    public function exportCarPerformance(){
        return Excel::download(new CarPerformanceExport, 'invoices.xlsx');

    }
}
