<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FinancialOrderReportsController extends Controller
{

    public function index(Request $request){

        $fromDate = '';
        $toDate = '';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.FinancialOrderReports') . '?month=' . date('Y-m') . '&type=month');
        }//end fun


        $soros = User::where ('user_type',4)->where('name','soro')->first();


       $washs = User::where ('user_type',4)->where('name','wash')->first();
       $marketers = User::where ('user_type',4)->where('name','marketer')->first();
       $ghaseels = User::where ('user_type',4)->where('name','ghaseel')->first();
       $carspas = User::where ('user_type',4)->where('name','carspa')->first();
       $sparkles = User::where ('user_type',4)->where('name','sparkle')->first();
       $sayars = User::where ('user_type',4)->where('name','sayar')->first();
       $T1654s = User::where ('user_type',4)->where('name','T1654')->first();
       $T3671s = User::where ('user_type',4)->where('name','T3671')->first();
       $T1677s = User::where ('user_type',4)->where('name','T1677')->first();
       $T7982s = User::where ('user_type',4)->where('name','T7982')->first();
       $T3996s = User::where ('user_type',4)->where('name','T3996')->first();
       $T4482s = User::where ('user_type',4)->where('name','T4482')->first();
       $T2470s = User::where ('user_type',4)->where('name','T2470')->first();
       $dones = User::where ('user_type',4)->where('name','done')->first();
       $t4762s = User::where ('user_type',4)->where('name','t4762')->first();
       $t4651s = User::where ('user_type',4)->where('name','t4651')->first();
        $sahars = User::where ('user_type',4)->where('name','سحر')->first();
        $sibrahims = User::where ('user_type',4)->where('name','ابراهيم 2')->first();
        $ghadas = User::where ('user_type',4)->where('name','غادة')->first();
        $skhaleds = User::where ('user_type',4)->where('name','خالد')->first();
        $monas = User::where ('user_type',4)->where('name','mona')->first();
        $gawharahs = User::where ('user_type',4)->where('name','الجوهرة')->first();
        $lamas = User::where ('user_type',4)->where('name','لمى')->first();
        $herags = User::where ('user_type',4)->where('name','حراج')->first();

        $WhooshSquads = User::where('user_type',0)->get();


        $betweenMonth = [$fromDate, $toDate];
//        return $betweenMonth;






        return view('admin.financial_order_reports.index',compact('soros',
            'WhooshSquads','washs','marketers','ghaseels','carspas','sparkles','sayars','T1654s',
        'T3671s','T1677s','T7982s','T3996s','T4482s','T2470s','dones','t4762s','t4651s','sahars',
        'sibrahims','ghadas','skhaleds','monas','gawharahs','lamas','herags','request'));


    }
    public function export()
    {
        return Excel::download(new SalaryAndCommissionController(), 'file.xlsx');
    }

}




