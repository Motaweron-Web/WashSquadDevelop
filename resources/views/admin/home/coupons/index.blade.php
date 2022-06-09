@extends('admin.layouts.inc.app')
@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> أكواد الخصم </a>
            </li>
        </ol>
        <a href="{{route('createcoupon')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- discounts -->
    <section class=" discounts drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> الكود </th>
                    <th> تاريخ الانشاء </th>
                    <th> تاريخ الانتهاء </th>
                    <th> نسبة الخصم </th>
                    <th> الدفع </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                <tr class="serv-border">
                    <td> {{$coupon->discount_coupon_code}} </td>
                    <td> {{$coupon->date_created}}</td>
                    <td> {{$coupon->expiry_date}}</td>
                    <td> {{$coupon->ratio}} </td>
                    <td>

                    @foreach($coupon->payments as $payment)

                        {{$payment->type}}-

                        @endforeach

                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="#!" class="status" data-bs-toggle="modal"
                               data-bs-target="#discountStatus"> <i class="fas fa-chart-bar"></i> </a>
                            <div couponid="{{$coupon->id}}" class="form-check form-switch ms-3 changecouponstatus">
                                <input class="form-check-input" id="wash" type="checkbox" role="switch"
                                   @if($coupon->status==1)    checked  @endif >
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- End discounts -->
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="discountStatus" data-bs-backdrop="static"
         tabindex="-1" aria-labelledby="discountStatusLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountStatusLabel"> C15% </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/1.svg')}}" alt="">
                                <h6> عدد مرات الاستخدام </h6>
                                <p class="discountCount"> 20 <span> طلب </span> </p>
                            </div>
                        </div>
                        <!-- end status -->
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/2.svg')}}" alt="">
                                <h6> عدد العملاء </h6>
                                <p class="discountCount"> 40 <span> عميل </span> </p>
                            </div>
                        </div>
                        <!-- end status -->
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/3.svg')}}" alt="">
                                <h6> المبيعات </h6>
                                <p class="discountCount"> 51618 <span> ريال </span> </p>
                            </div>
                        </div>
                        <!-- end status -->
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/4.svg')}}" alt="">
                                <h6> نسبة المسوق</h6>
                                <p class="discountCount"> 199 <span> ريال </span> </p>
                            </div>
                        </div>
                        <!-- end status -->

                    </div>


                    <form action="">
                        <div class="row align-items-end justify-content-center mb-3">
                            <div class=" col col-md-7 p-2">
                                <label class="form-label"> الفترة </label>
                                <input class="form-control" type="date">
                            </div>
                            <div class=" col col-md-2 p-2">
                                <button type="submit" class="btn mainBtn"> عرض </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>







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
    <script>
        $(document).on("click",".deletepayment", function (e) {
            e.preventDefault();
            var id= $(this).attr('paymentid');

            $.ajax({
                type:'GET',
                url:"{{route('deletepayment')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>


    <script>
        $(document).on("click",".changecouponstatus", function (e) {
            var id= $(this).attr('couponid');
            $.ajax({
                type:'GET',
                url:"{{route('changecouponstatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {


                    }
                    else if(res['status']==false)
                        location.reload();

                    else
                    {
                        location.reload();
                    }


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>



@endsection
