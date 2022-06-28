@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')



@endsection

@section('content')

            <!-- breadcrumb -->
            @include('admin.alerts.success')
            @include('admin.alerts.errors')
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"> <a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>
            <!-- end breadcrumb -->

            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('admin.AppSettingFaq.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"> السؤال  باللغة العربية </label>
                        <input class="form-control" type="text" name="ar_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> الجواب  باللغة العربية </label>
                        <textarea class="form-control" rows="5" name="ar_content"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> السؤال  باللغة الانجليزية </label>
                        <input class="form-control" type="text" name="en_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> الجواب  باللغة الانجليزية </label>
                        <textarea class="form-control" rows="5" name="en_content"></textarea>
                    </div>


                    <div class="text-end py-2">
                        <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                    </div>
                </form>
            </section>
            <!-- end edit Service -->



            @endsection
                @section('js')


@endsection

