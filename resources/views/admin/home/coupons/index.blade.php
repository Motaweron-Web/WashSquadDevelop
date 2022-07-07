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

                    @foreach($coupon->payments as $index=> $payment)

                        @if($index==0)
                                {{$payment->type}}
                            @else
                        {{$payment->type}}-
                            @endif
                        @endforeach

                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="#!" data-id="{{$coupon->id}}" class="status showDetails" data-bs-toggle="modal"
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
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{$coupons->previousPageUrl()}}">Previous</a>
                    </li>
                    @for($i=1;$i<=$coupons->lastPage();$i++)
                        <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                    @endfor
                    <li class="page-item ">
                        <a class="page-link"  href="{{$coupons->nextPageUrl()}}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
    </section>
    <!-- End discounts -->
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="discountStatus" data-bs-backdrop="static"
         tabindex="-1" aria-labelledby="discountStatusLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountStatusLabel" > C15% </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/1.svg')}}" alt="">
                                <h6 > عدد مرات الاستخدام </h6>
                                <p class="discountCount" id="m-numberOfUses"> 20 <span> طلب </span> </p>
                            </div>
                        </div>
                        <input type="hidden" id="order-model-id">
                        <!-- end status -->
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/2.svg')}}" alt="">
                                <h6> عدد العملاء </h6>
                                <p class="discountCount"id="m-numberOfUsers"> 40 <span> عميل </span> </p>
                            </div>
                        </div>
                        <!-- end status -->
                        <!-- status -->
                        <div class="col-sm-6 p-3">
                            <div class="DisStatus">
                                <img src="{{asset('assets/images/discounts/3.svg')}}" alt="">
                                <h6> المبيعات </h6>
                                <p class="discountCount" id="m-salaries"> 51618 <span> ريال </span> </p>
                            </div>
                        </div>
                        <!-- end status -->
                        <!-- status -->
{{--                        <div class="col-sm-6 p-3">--}}
{{--                            <div class="DisStatus">--}}
{{--                                <img src="{{asset('assets/images/discounts/4.svg')}}" alt="">--}}
{{--                                <h6> نسبة المسوق</h6>--}}
{{--                                <p class="discountCount"> 199 <span> ريال </span> </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- end status -->

                    </div>


                        <div class="row align-items-end justify-content-center mb-3">
                            <div class=" col col-md-7 p-2">
                                <label class="form-label"> الفترة </label>
                                <input class="form-control" id="order-date" type="date">
                            </div>
                            <div class=" col col-md-2 p-2">
                                <button type="submit" id="showDetailsByDate" class="btn mainBtn"> عرض </button>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>







@endsection



@section('style')



@endsection

@section('js')
            <script>
                @if(session()->has('message'))

                toastr.success('تمت العملية بنجاح');
                @endif

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
                 toastr.success('تم تحديث الحالة بنجاح')

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


            <script>

                $('.showDetails').click(function(){
                    $(`#order-date`).val('');
                    var id= $(this).attr('data-id');
                    $(`#order-model-id`).val(id);
                    $.ajax({
                        type:'GET',
                        url:"{{route('admin.couponDetails')}}",
                        data:{
                            id:id,

                        },

                        success:function(res){
                            if(res['status']==true)
                            {
                                toastr.success('تم تنفيذ طلبك بنجاح')
                                 $(`#m-numberOfUsers`).html(`${res['numberOfUsers']} <span> عميل </span> `);
                                $(`#m-numberOfUses`).html(`${res['numberOfUses']} <span> طلب </span> `);
                                $(`#m-salaries`).html(`${res['salaries']} <span> ريال </span> `);
                                  $(`#discountStatusLabel`).text(res['coupon']['discount_coupon_code']);

                            }
                            else if(res['status']=='error') {
                                toastr.error('يرجي التاكد من البيانات');

                            }
                            else {
                               //  location.reload();
                            }
                        },
                        error: function(data){
                            toastr.error('يرجي   المحاولة لاحفا');
                        }
                    });



                });

            </script>


            <script>
                $('#showDetailsByDate').click(function() {

                    var date=$(`#order-date`).val();
                    var id=$(`#order-model-id`).val();

                    $.ajax({
                        type:'GET',
                        url:"{{route('admin.couponDetailsByDate')}}",
                        data:{
                            id:id,
                            date:date,
                        },

                        success:function(res){
                            if(res['status']==true)
                            {
                                toastr.success('تم تنفيذ طلبك بنجاح');
                                $(`#m-numberOfUsers`).html(`${res['numberOfUsers']} <span> عميل </span> `);
                                $(`#m-numberOfUses`).html(`${res['numberOfUses']} <span> طلب </span> `);
                                $(`#m-salaries`).html(`${res['salaries']} <span> ريال </span> `);



                            }
                            else if(res['status']=='error') {
                                toastr.error('يرجي التاكد من البيانات');

                            }
                            else {
                                //  location.reload();
                            }
                        },
                        error: function(data){
                            toastr.error('يرجي   المحاولة لاحفا');
                        }
                    });



                } );
            </script>

@endsection
