@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')



@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('admin.OnlineStoreCategories')}}"> التصنيفات
                </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <!-- edit Service -->
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('admin.OnlineStoreCategories.update' ,$OnlineStoreCategories->id)}}" method="post">
            @csrf
            <div class="row">

                <div class="col-md-12 p-2">
                    <label class="form-label"> اسم التصنيف  باللغة العربية </label>
                    <input class="form-control" type="text" name="title_ar" value="{{$OnlineStoreCategories->title_ar}}">
                </div>
                <div class="col-md-12 p-2">
                    <label class="form-label"> اسم التصنيف  باللغة الانجليزية </label>
                    <input class="form-control" type="text"  name="title_en" value="{{$OnlineStoreCategories->title_en}}">
                </div>

            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn "> تحديث </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->


@endsection
@section('js')


@endsection
