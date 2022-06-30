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
                <form action="{{route('admin.Apps.update',$Apps->id)}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <div class="text-center">
                            <img
                                src="{{asset($Apps -> logo)}}"
                                class="rounded-circle  height-150" alt="الشعار">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="mb-4">
                                <label class="form-label"> اسم التطبيق/ المسوق </label>
                                <input class="form-control" type="text" name="" value="{{$Apps->name}}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> تاريخ الانضمام </label>
                                <input class="form-control" type="date" name="created_at" value="{{$Apps->created_at}}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> نسبة العمولة لكل طلب </label>
                                <input class="form-control" type="number" name="ratio" value="{{$Apps->ratio}}">
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="mb-3">
                                <label class="form-label"> الصورة </label>
                                <div action="#" class="dropzone">
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
                                <input class="form-control" type="number" name="IBN_number" value="{{$Apps->IBN_number}}">
                            </div>
                        </div>



                        <div class="col-md-12 p-2">
                            <label class="form-label"> طرق الدفع </label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="CASH" @if($Apps->payment_method!=null) {{in_array(json_decode($Apps->Payment_method),'CASH')?'checked':''}}  @endif id="pay1" name="Payment_method[]">
                                <label class="form-check-label" for="pay1">
                                    CASH
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="POS"   @if($Apps->payment_method!=null)  {{in_array(json_decode($Apps->Payment_method),"POS")?'checked':''}}@endif id="pay2" name="Payment_method[]">
                                <label class="form-check-label" for="pay2">
                                    POS
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="ONLINE" @if($Apps->payment_method!=null)  {{in_array(json_decode($Apps->Payment_method),'ONLINE')?'checked':''}}@endif id="pay3" name="Payment_method[]">
                                <label class="form-check-label" for="pay3">
                                    ONLINE
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 p-2">
                            <label class="form-label"> الباقات الرئيسية </label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="polishing_washing"  @if($Apps->main_packages!=null)  {{in_array(json_decode($Apps->main_packages),'polishing_washing')?'checked':''}}@endif  id="package1" name="main_packages[]">
                                <label class="form-check-label" for="package1">
                                    تلميع داخلي مع غسيل بخار خارجي
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="steam_wash" @if($Apps->main_packages!=null)  {{in_array(json_decode($Apps->main_packages),'steam_wash')?'checked':''}}@endif id="package2" name="main_packages[]">
                                <label class="form-check-label" for="package2">
                                    غسيل بالبخار داخلي و خارجي
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="sterilization" @if($Apps->main_packages!=null)   {{in_array(json_decode($Apps->main_packages),'sterilization')?'checked':''}}@endif id="package3" name="main_packages[]">
                                <label class="form-check-label" for="package3">
                                    تعقيم داخلي مع غسيل بخار خارجي
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="sent_Services" @if($Apps->main_packages!=null)  {{in_array(json_decode($Apps->main_packages),'sent_Services')?'checked':''}}@endif id="package4" name="main_packages[]">
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
                                <input class="form-check-input" id="wash" type="checkbox"  value="1" role="switch" checked>
                                @if($Apps -> is_active == 1)checked @endif>
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

@endsection
