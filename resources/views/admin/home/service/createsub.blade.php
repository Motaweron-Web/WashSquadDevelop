@extends('admin.layouts.inc.app')

@section('content')

@endsection
<div class="main-content">
    <div class="page-content">
        <!-- breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="{{route('getallservices')}}"> الخدمات </a> </li>
                <li class="breadcrumb-item active"> <a href="#!"> غسيل </a> </li>
                <li class="breadcrumb-item active"> <a href="#!"> اضاقة </a> </li>
            </ol>
            <button class="btn btn-dark" onclick="history.back()"> عودة </button>
        </div>
        <!-- end breadcrumb -->

        <!-- edit Service -->
        <section class="editService">
            <form action="{{route('addsubservice',$service->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> عنوان الباقة باللغة العربية </label>
                    <input class="form-control" name="ar_title" value=""  type="text" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label"> تفاصيل الباقة باللغة العربية </label>
                    <textarea class="form-control" name="ar_des" rows="5"> </textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label"> عنوان الباقة باللغة الانجليزية </label>
                    <input class="form-control" name="en_title" value=""  type="text" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label"> تفاصيل الباقة باللغة الانجليزية </label>
                    <textarea class="form-control" name="en_des" rows="5"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <label class="form-label"> صورة الخدمة عربي </label>

                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file"  name="ar_image" id="input-file-now-custom-1" class="dropify"
                                       data-default-file="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <label class="form-label"> صورة الخدمة انجليزي </label>
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file"  name="en_image" id="input-file-now-custom-2" class="dropify"
                                       data-default-file="" >
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    @foreach($carsizes as $carsize)
                        <div class="col-md-5 p-2">
                            <div class="mb-3">
                                <label class="form-label"> {{$carsize->ar_title}} </label>
                                <input class="form-control" name="prices[]" value="0" type="text" placeholder="">
                            </div>
                        </div>

                    @endforeach
                        <div class="col-md-5 p-2">
                            <label class="form-label"> الخدمات الاضافية </label>
                            @foreach($subfromsubservices as $service )
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="subsubservices[]" type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                                    <label class="form-check-label" for="{{$service->id}}">
                                        {{$service->ar_title}}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-md-5 p-2">
                            <label class="form-label"> طرق الدفع </label>
                            @foreach($payments as $payment)
                                <div class="form-check mb-2">
                                    <input class="form-check-input"  value="{{$payment->id}}" name="payment[]"  type="checkbox"  id="{{$payment->id}}">
                                    <label class="form-check-label" for="{{$payment->id}}">
                                        {{$payment->type}}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    <div class="col-md-5 p-2">
                        <div class="mb-3">
                            <label class="form-label"> وقت الخدمة</label>
                            <input class="form-control" name="timer" value=""  type="time" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="text-end py-2">
                    <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                </div>
            </form>
        </section>
        <!-- end edit Service -->





    </div>
</div>

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.min.css')}}">
    <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>


@endsection

@section('js')
    <script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>

    <script>
        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif

    </script>

    <script>
        $('.dropify').dropify();
        $(function () {
            $(document).on("click", "#saveImage", function (event) {
                let myForm = document.getElementById('saveForm');
                let formData = new FormData(myForm);
                uploadImage(formData);
                console.log(formData);
            });
        });


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
<script>

    CKEDITOR.replace('ar_des');
    CKEDITOR.replace('en_des');
</script>


@endsection
