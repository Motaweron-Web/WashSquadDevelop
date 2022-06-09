<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\OrderExport;

class ExportController extends Controller
{
    //
    public  function exportorders ()
    {
        return Excel::download(new OrderExport, 'invoices.xlsx');
    }
}
