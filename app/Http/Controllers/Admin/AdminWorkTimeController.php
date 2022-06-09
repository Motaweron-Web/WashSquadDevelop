<?php
namespace App\Http\Controllers\Admin;
use App\DateTime;
use App\WorkTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminWorkTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workTimes = WorkTime::where('is_deleted', 0)
            ->where('id', '!=', 27)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.workTime.index')->with(['workTimes' => $workTimes]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workTime.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
        ]);
        if ($request->end_time < $request->start_time) {
            toastr()->error('لا يجب أن تكون فترة النهاية ا');
            return redirect(route('workTimes.index'));
        }
        $workTime = new WorkTime();
        $workTime->start_time = $request->start_time;
        $workTime->end_time = $request->end_time;
        $workTime->time_text = $request->end_time . '-' . $request->start_time;
        $workTime->type = $request->type;
        $workTime->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));
        return redirect(route('workTimes.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workTime = WorkTime::find($id);
        return view('admin.workTime.edit')->with(['workTime' => $workTime]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
        ]);
        $workTime = WorkTime::find($id);
        $workTime->start_time = $request->start_time;
        $workTime->end_time = $request->end_time;
        $workTime->time_text = $request->end_time . '-' . $request->start_time;
        $workTime->type = $request->type;
        $workTime->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));
        return redirect(route('workTimes.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete(Request $request)
    {
        $good = WorkTime::where("id", $request->id)->update(["is_deleted" => 1]);
        if ($good)
            return response(['error' => 0]);
        else
            return response(['error' => 1]);
    }
}
