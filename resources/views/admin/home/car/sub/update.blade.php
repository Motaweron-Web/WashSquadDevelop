@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getcartype')}}"> أنواع السيارات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> اضافة </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->

    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('updatesubcar',$car->id)}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label"> النوع باللغة العربية </label>
                <input class="form-control" value="{{$car->ar_title}}" name="ar_title" type="text" >
            </div>
            <div class="mb-3">
                <label class="form-label"> النوع باللغة الانجليزية </label>
                <input class="form-control" value="{{$car->en_title}}" name="en_title" type="text" >
            </div>

            <div class="mb-3">
                <label class="form-label"> النوع </label>
                <select name="parent_id" class="form-select">
                    @foreach($maincars as $maincar)
                        <option @if($car->parent_id==$maincar->id) selected @endif value="{{$maincar->id}}"> {{$maincar->ar_title}} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label"> الحجم </label>
                <select name="size" class="form-select">
                    @foreach($sizes as $size)
                        <option @if($size->id==$car->size) selected @endif value="{{$size->id}}"> {{$size->ar_title}} </option>
                    @endforeach
                </select>
            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->





@endsection




@section('style')


@endsection

@section('js')
        <script>

            @if($errors->any())
            toastr.error('يرحي التاكد من البيانت المدخلة');
            @endif


        </script>

@endsection



