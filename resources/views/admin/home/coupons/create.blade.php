@extends('admin.layouts.inc.app')
@section('content')




    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getcoupons')}}"> أكواد الخصم </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addcoupon')}}" method="post" class="p-3">
            @csrf
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> كود كوبون الخصم </label>
                        <input name="discount_coupon_code" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="mb-3">
                        <label class="form-label"> تاريخ الانشاء </label>
                        <input name="date_created" class="form-control" type="date">
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="mb-3">
                        <label class="form-label"> تاريخ الانتهاء </label>
                        <input name="expiry_date" class="form-control" type="date">
                    </div>
                </div>
                <div class="col-md-12 p-2">
                    <div class="mb-3">
                        <label class="form-label"> نوع الخصم </label>
                        <div class="d-flex align-items-center">
                            <div class="form-check px-4">
                                <input  class="form-check-input" type="radio" name="discount_type" id="type1" value="خصم بنسبة من مجموع الطلب">
                                <label class="form-check-label" for="type1">
                                    خصم بالنسبة من مجموع الطلب
                                </label>
                            </div>
                            <div class="form-check px-4">
                                <input class="form-check-input" type="radio" name="discount_type" id="type2" value="كاش باك ف المحفظة">
                                <label class="form-check-label" for="type2">
                                    كاش باك في المحفظة
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> النسبة/المبلغ </label>
                        <input class="form-control" name="ratio" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <label class="form-label"> خدمات مستثناه لا يشملها الخصم </label>
                    @foreach($services as $service)
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="services[]" type="checkbox" value="{{$service->id}}" id="service1">
                        <label class="form-check-label" for="service1">
                            {{$service->ar_title}}

                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> طرق الدفع </label>
                    @foreach($payments as $payment)
                    <div class="form-check mb-2">
                        <input name="payments[]" class="form-check-input" type="checkbox" value="{{$payment->id}}" id="pay1">
                        <label class="form-check-label" for="pay1">
                            {{$payment->type}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> الحد الأدنى للطلب </label>
                        <input class="form-control" name="minimum_order" type="text">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> نسبة المسوق من مبيعات الكود </label>
                        <input name="market_percentage_code_sales" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> عدد مرات الاستخدام للعميل </label>
                        <input class="form-control" name="number_customer_used" type="number">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="mb-3">
                        <label class="form-label"> عدد مرات الاستخدام للجميع </label>
                        <input class="form-control" name="number_all_used" type="number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <label class="form-label"> عملاء مستثنين لا يشملهم كود الخصم </label>
                    <div class="form-check mb-2">
                        <input name="clients_excluded[]"  class="form-check-input" type="checkbox" value="vip_client" id="service1">
                        <label class="form-check-label" for="service1">
                            عملاء VIP
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input name="clients_excluded[]" class="form-check-input" type="checkbox" value="client_not_ordered" id="service2">
                        <label class="form-check-label" for="service2">
                            عملاء جدد لم يطلب بعد
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input name="clients_excluded[]" class="form-check-input" type="checkbox" value="cancel_client" id="service3">
                        <label class="form-check-label" for="service3">
                            عملاء تم الالغاء
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input name="clients_excluded[]" class="form-check-input" type="checkbox" value="client_served" id="service4">
                        <label class="form-check-label" for="service4">
                            عملاء تمت خدمتهم
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>


        </form>
    </section>
    <!-- end edit Service -->













@endsection

@section('style')

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <!-- apexcharts js -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>



@endsection
