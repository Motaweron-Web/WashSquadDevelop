@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')


@endsection

@section('content')


    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{route('admin.AppSettingSocial')}}"> وسائل التواصل الاجتماعي </a>
            </li>
        </ol>
        <!-- <button class="btn btn-dark" onclick="history.back()"> عودة </button> -->
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')

    <section class="editService">
        @foreach($AppSettingSocials as $AppSettingSocial)
            <form action="{{route('admin.AppSettingSocial.update',$AppSettingSocial->id)}}" method="POST">
                @csrf
                <!-- twitter -->
                <div class="social">
                    <div class="icon me-3">
                        <i class="fab fa-{{$AppSettingSocial->title}}"></i>
                    </div>
                    <div class="form-group">
                        <label for=""> رابط الحساب </label>
                        <input type="text" class="form-control" name="link" placeholder="ادخل قيمة"
                               value="{{$AppSettingSocial->link }}">
                    </div>

                    <button type="submit" class="btn ms-3 orangeBtn"> ربط </button>
                </div>
            </form>

        @endforeach
    </section>


@endsection
@section('js')


@endsection

