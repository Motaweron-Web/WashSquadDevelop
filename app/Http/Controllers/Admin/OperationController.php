<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    //

    public function getoperation()
    {
        $neworders = Order::where('status', 1)->with('service', 'driver')->get();
        $roadorders = Order::where('status', 11)->with('service', 'driver')->get();
        $workorders=Order::where('status',2)->with('service','driver')->get();
        $cancelorders=Order::where('status',5)->with('service','driver')->get();
        $doneorders=Order::where('status',3)->with('service','driver')->get();
        $finishorders=Order::where('status',13)->with('service','driver')->get();
        return view('admin.home.operation.index');

    }
}
