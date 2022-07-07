@extends('admin.layouts.inc.app')
@section('style')


    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

        <div class="page-content">
            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"> <a href="{{route('admin.Apps')}}"> التطبيقات </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>

            <!-- end breadcrumb -->
            <!-- edit Service -->

            @include('admin.alerts.success')
            @include('admin.alerts.errors')
            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('admin.Apps.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="mb-4">
                                <label class="form-label"> اسم التطبيق/ المسوق </label>
                                <input class="form-control" type="text" name="name" value="">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> تاريخ الانضمام </label>
                                <input class="form-control" type="date" name="created_at" value="">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> نسبة العمولة لكل طلب </label>
                                <input class="form-control" type="number" name="ratio" value="">
                            </div>
                        </div>

                        <div class="col-md-6 p-2">
                            <div class="mb-3">
                                <label class="form-label"> الصورة </label>
                                <div action ="" class="dropzone">
                                    <div class="fallback">
                                        <input name="logo" type="file">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <i class="display-6 mo-icon  fas fa-images"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> رقم الايبان </label>
                                <input class="form-control" type="number" name="IBN_number" value="">
                            </div>
                        </div>


                        <div class="col-md-12 p-2">
                            <label class="form-label"> طرق الدفع </label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="CASH"  id="pay1" name="Payment_method[]">
                                <label class="form-check-label" for="pay1">
                                    CASH
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="POS" id="pay2" name="Payment_method[]">>
                                <label class="form-check-label" for="pay2">
                                    POS
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="ONLINE" id="pay3" name="Payment_method[]">>
                                <label class="form-check-label" for="pay3">
                                    ONLINE
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 p-2">
                            <label class="form-label"> الباقات الرئيسية </label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="polishing_washing" id="package1" name="main_packages[]">
                                <label class="form-check-label" for="package1">
                                    تلميع داخلي مع غسيل بخار خارجي
                                </label>
                                steam_wash

                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="steam_wash" id="package2" name="main_packages[]">
                                <label class="form-check-label" for="package2">
                                    غسيل بالبخار داخلي و خارجي
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="sterilization" id="package3" name="main_packages[]">
                                <label class="form-check-label" for="package3">
                                    تعقيم داخلي مع غسيل بخار خارجي
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="sent_Services" id="package4" name="main_packages[]">
                                <label class="form-check-label" for="package4">
                                    ارسال خدمة
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-content-center justify-content-between py-2">
                        <div class="d-flex align-items-center ">
                            <label class="form-label m-0"> تفعيل الحساب </label>
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" id="wash" type="checkbox" role="switch" checked  name="is_active">
                            </div>
                        </div>
                        <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                    </div>
                </form>
            </section>
        </div>

@endsection

@section('js')

    <script src="{{asset('assets/admin/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script>

        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif
    </script>

@endsection
