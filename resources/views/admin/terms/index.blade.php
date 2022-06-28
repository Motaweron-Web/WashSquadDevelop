@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')


@endsection

@section('content')


    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href="app_setting_terms.html"> الاشعارات </a> </li>
        </ol>
        <!-- <button class="btn btn-dark" onclick="history.back()"> عودة </button> -->
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <section class="editService">
        <form action="{{route('admin.AppSettingTerms.update',$AppSettingTermss->id)}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$AppSettingTermss ->id}}">
            <div class="mb-3">

            </div>
            <div class="mb-3">
                <label class="form-label"> الشروط و الاحكام باللغة الانجليزية </label>
                <textarea class="form-control" rows="5" name="en_content"> {{$AppSettingTermss -> en_content}}</textarea>
            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>

                @endsection
                @section('js')


@endsection

