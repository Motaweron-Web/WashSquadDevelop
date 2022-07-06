@extends('admin.layouts.inc.app')
@section('class')
    orders-table operation
@endsection
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.min.css')}}">
@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{route('admin.AppSettingDrivers')}}"> السائقين </a></li>
            <li class="breadcrumb-item active"><a href="#!"> جديد </a></li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة</button>
    </div>
    <!-- end breadcrumb -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('admin.AppSettingDrivers.store')}}" method="post" inlist="" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="mb-4">
                        <label class="form-label"> كود السائق </label>
                        <input class="form-control" type="number" name="name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> نسبة العمولة لكل طلب </label>
                        <input class="form-control" type="number" name="commission">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> اسم المستخدم </label>
                        <input class="form-control" type="text" name="full_name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> اسم السائق </label>
                        <input class="form-control" type="text" name="driver_name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> رقم الجوال </label>
                        <input class="form-control" type="number" name="phone">
                    </div>

                </div>

                <!--##############################dropeyfy###############################-->
                <div class="col-md-6 p-2" id="saveForm">
                    <label class="form-label"> الصورة </label>
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="file" name="logo" id="input-file-now-custom-2" class="dropify"
                                   data-default-file="">
                        </div>
                    </div>

                </div>

                <!--##############################end dropeyfy###############################-->

                <div class="mb-3" >
                    <label class="form-label"> كلمة المرور </label>
                    <input class="form-control" type="password" name="password" placeholder="**********" >
                </div>
                <div class="mb-3">
                    <label class="form-label"> اسم العامل </label>
                    <input class="form-control" type="number" name="worker_name">
                </div>


            </div>


            </div>
            <div class="d-flex align-content-center justify-content-between py-2">
                <div class="d-flex align-items-center ">
                    <label class="form-label m-0"> تفعيل الحساب </label>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" name="is_active" value="1" id="wash" type="checkbox"
                               role="switch" checked>
                    </div>
                </div>

                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق</button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->

    </div>
    </div>

@endsection

@section('js')

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

<script>


    @if($errors->any())
    toastr.error('يرحي التاكد من البيانت المدخلة');
    @endif
</script>
@endsection

