<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\GroupPeriod;
use App\Models\Period;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;

class AvailableTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //////////////////////////// for calender ////////////////////////////
        $month = date('m', strtotime($request->month ?? date('Y-m')));
        $year = date('Y', strtotime($request->month ?? date('Y-m')));

        $number_of_day = date('t', mktime(0, 0, 0, $month, 1, $year));

        $start_day = date('w', strtotime($year . '-' . $month . '-01')) + 1;

        $prev_year = date('Y', strtotime('-1 year', strtotime($year . '-' . $month . '-01')));
        $prev_month = date('m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')));
        $next_year = date('Y', strtotime('+1 year', strtotime($year . '-' . $month . '-01')));
        $next_month = date('m', strtotime('+1 month', strtotime($year . '-' . $month . '-01')));


        return view('admin.available_times.index', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
    }
    public function anotherMonth(Request $request)
    {
        //////////////////////////// for calender ////////////////////////////
        $month = date('m', strtotime($request->month ?? date('Y-m')));
        $year = date('Y', strtotime($request->month ?? date('Y-m')));

        $number_of_day = date('t', mktime(0, 0, 0, $month, 1, $year));

        $start_day = date('w', strtotime($year . '-' . $month . '-01')) + 1;

        $prev_year = date('Y', strtotime('-1 year', strtotime($year . '-' . $month . '-01')));
        $prev_month = date('m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')));
        $next_year = date('Y', strtotime('+1 year', strtotime($year . '-' . $month . '-01')));
        $next_month = date('m', strtotime('+1 month', strtotime($year . '-' . $month . '-01')));

        ///////////////////////////////// end calender //////////////////////////

        $html = view('admin.available_times.parts.anotherMonth', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
        return response(['html' => "$html", 'status' => 200]);

        return view('admin.available_times.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $groups = Group::with('days','periods')->get();
//        return $groups;
        $periods = Period::orderBy('en_period_type')->orderBy('period_title')->get();
//        return $groups;
        $arrayOfKeys = [];
        $arrayOfIds = [];



        $html = view('admin.available_times.parts.data',compact('id','groups','periods','arrayOfKeys','arrayOfIds'));

        return response(['html'=>"$html"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
