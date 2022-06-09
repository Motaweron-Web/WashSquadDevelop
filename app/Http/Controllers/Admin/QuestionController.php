<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=Question::all();
        return view('admin.questions.index')->with(['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'en_content' => 'required|string',
            'ar_content' => 'required|string',

        ]);

        $question=new Question();
        $question->en_title=$request->en_title;
        $question->ar_title=$request->ar_title;
        $question->en_content=$request->en_content;
        $question->ar_content=$request->ar_content;


        $question->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=Question::find($id);
        return view('admin.questions.edit')->with(['question'=>$question]);
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
        $this->validate($request,[

            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'en_content' => 'required|string',
            'ar_content' => 'required|string',

        ]);

        $question=Question::find($id);
        $question->en_title=$request->en_title;
        $question->ar_title=$request->ar_title;
        $question->en_content=$request->en_content;
        $question->ar_content=$request->ar_content;

        $question->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('questions.index'));
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


    public function delete(Request $request)
    {

        $good= Question::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
