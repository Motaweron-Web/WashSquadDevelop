@extends('admin.layouts.inc.app')

@section('content')


            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"> <a href="{{route('getallservices')}}"> الخدمات </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> غسيل </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> تعديل </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>
            <!-- end breadcrumb -->

            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('updateservice',$service->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"> عنوان الخدمة باللغة العربية </label>
                        <input class="form-control" name="ar_title" value="{{$service->ar_title}}" type="text" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> عنوان الخدمة باللغة الانجليزية </label>
                        <input class="form-control" type="text" name="en_title" value="{{$service->en_title}}" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <label class="form-label"> صورة الخدمة عربي </label>

                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="file"  name="ar_image" id="input-file-now-custom-1" class="dropify"
                                           data-default-file="{{asset(''.$service->ar_image)}}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label"> صورة الخدمة انجليزي </label>
                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="file"  name="en_image" id="input-file-now-custom-2" class="dropify"
                                           data-default-file="{{asset(''.$service->en_image)}}" >
                                </div>
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
@endsection

@section('style')



    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.min.css')}}">
@endsection

@section('js')

    <script>
        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>



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

@endsection

