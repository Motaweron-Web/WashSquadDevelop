@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')
    admin.AppSettingSupport.update
@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('admin.AppSettingSupport')}}"> وسائل الدعم و المساعدة </a>
            </li>
        </ol>
        <!-- <button class="btn btn-dark" onclick="history.back()"> عودة </button> -->
    </div>
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        @foreach($AppSettingSupports as $AppSettingSupport)
        <form action="{{route('admin.AppSettingSupport.update',$AppSettingSupport->id)}}" method="POST">
            <!-- whatsapp -->@csrf
        <div class="social">

            <div class="icon me-3">
                <i class="{{$AppSettingSupport->title}}"></i>
            </div>
            <div class="form-group">
                <label for=""> رابط الحساب </label>
                <input type="text" class="form-control" name="link" value="{{$AppSettingSupport->link}}">
            </div>
            <button type="submit" class="btn ms-3 orangeBtn"> ربط </button>

        </div>
        <!-- email -->
        </form>

        @endforeach
    </section>
@endsection
@section('js')

@endsection

