<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class FinancialOrderReportsController extends Controller
{
    public function index(){
        $UserEmploys = Order::where([user_type,null],[])->Selection()->paginate(10);
        return view('admin.financial_order_reports.index');
    }
}
