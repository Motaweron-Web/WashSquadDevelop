@extends('admin.layouts.inc.app')
@section('class')
    add driver form
@endsection
@section('style')


@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{route('admin.AppSettingDrivers.creat')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- drivers -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <section class="drivers ">

        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> الصورة</th>
                    <th> الكود</th>
                    <th> العمولة</th>
                    <th> الحالة</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @isset($AppSettingDrivers)
                    @foreach($AppSettingDrivers as $AppSettingDriver)
                        <tr class="serv-border">
                            @if(file_exists($AppSettingDriver -> logo))
                                <td><img src="{{asset($AppSettingDriver -> logo)}}"></td>
                            @else
                                <td><img src="{{asset('assets/images/default.jpg')}}"></td>
                            @endif
                            <td> {{$AppSettingDriver->name}} </td>
                            <td> {{$AppSettingDriver->commission}} </td>

                            <td>{{$AppSettingDriver -> is_confirmed == 1?'مفعل':'غير مفعل'}}</td>

                            <td>

                                <div class="actionsIcons">
                                    <a href="#!" class="status showDetails" data-id="{{$AppSettingDriver->id}}" data-bs-toggle="modal"
                                       data-bs-target="#driverStatus"> <i class="fas fa-chart-bar"></i> </a>
                                    <a href="{{route('admin.AppSettingDrivers.edit',$AppSettingDriver->id)}}"
                                       class="edit"> <i class="fas fa-edit"></i> </a>
                                    <a href="{{route('admin.AppSettingDrivers.delete',$AppSettingDriver->id)}}"
                                       class="delete"> <i class="fas fa-trash-alt"></i> </a>
                                </div>
                            </td>
                        </tr>



                        <div class="modal fade driversModal" id="driverStatus" data-bs-backdrop="static" tabindex="-1"
                             aria-labelledby="driverStatusLabel">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="driverStatusLabel"> 2470 </h5>
                                        <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row align-items-end mb-3">
                                                <div class=" col col-md-7 p-2">
                                                    <label class="form-label"> الفترة </label>
                                                    <input id="order-date" class="form-control" type="date">
                                                </div>
                                                <div class=" col col-md-5 p-2">
                                                    <button type="submit" id="showDetailsByDate" class="btn mainBtn"> عرض </button>
                                                </div>
                                            </div>
                                        <!-- status Details -->
                                        <input type="hidden" id="order-model-id">
                                        <div class="statusDetails">
                                            <div class="row justify-content-center">
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/1.png')}}" alt="">
                                                            <h6> تلميع </h6>
                                                            <h3 id="m-polishing"> 20 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/2.png')}}" alt="">
                                                            <h6 > تعقيم </h6>
                                                            <h id="m-disinfect"> 20 </h>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/3.png')}}" alt="">
                                                            <h6> اشتراك </h6>
                                                            <h3 id="m-subscription"> 227 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/4.png')}}" alt="">
                                                            <h6> غسيل </h6>
                                                            <h3 id="m-wash"> 23 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/5.png')}}" alt="">
                                                            <h6 > commission </h6>
                                                            <h3 id="m-commission"> 950 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/6.png')}}" alt="">
                                                            <h6> Total order </h6>
                                                            <h3 id="m-totalOrder"> 78 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                            </div>
                                        </div>
                                        <!-- end status Details -->
                                        <!-- driver Rate -->
                                        <div class="driverRate">
                                            <div class="row">
                                                <div class="col-md-6 px-2 py-1">
                                                    <!-- driver status -->
                                                    <div class="driverStatus">
                                                        <div class="row">
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/card_giftcard_black_24dp.svg')}}"
                                                                        alt="">
                                                                    <h6> Total commission </h6>
                                                                    <h5 id="m-commission4x"> 4 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/Group 482.svg')}}"
                                                                        alt="">
                                                                    <h6> Total order </h6>
                                                                    <h5 id="m-order4x"> 4</h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/card_giftcard_black_24dp.svg')}}"
                                                                        alt="">
                                                                    <h6> Total commission </h6>
                                                                    <h5 id="m-commission5x"> 5 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/Group -1.svg')}}"
                                                                        alt="">
                                                                    <h6> Total order </h6>
                                                                    <h5 id="m-order5x"> 275 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <div class="col-6 px-1 pt-4">
                                                                <button onclick="convert()" class="btn export">
                                                                    <i class="fas fa-download me-2"></i>
                                                                    Export PDF
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- end driver status -->
                                                </div>
                                                <div class="col-md-6 p-2">
                                                    <!--full Rate  -->
                                                    <div class="fullRate">
                                                        <h6> AVERAGE REVIEWS CUSTOMER </h6>
                                                        <ol class="fiveStarRate">
                                                            <!-- five stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span id="px5" class="percent"
                                                                              style="width: 60% ;"></span>
                                                                    </div>
                                                                    <p class="total" id="m-x5"> 140 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end five stars -->
                                                            <!-- four stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span id="px4" class="percent"
                                                                              style="width: 20% ;"></span>
                                                                    </div>
                                                                    <p class="total" id="m-x4"> 60 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end four stars -->
                                                            <!-- three stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span id="px3" class="percent"
                                                                              style="width: 10% ;"></span>
                                                                    </div>
                                                                    <p class="total" id="m-x3"> 30 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end three stars -->
                                                            <!-- two stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span id="px2" class="percent"
                                                                              style="width: 100% ;"></span>
                                                                    </div>
                                                                    <p class="total" id="m-x2"> 16 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end two stars -->
                                                            <!-- one stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span id="px1" class="percent"
                                                                              style="width: 3% ;"></span>
                                                                    </div>
                                                                    <p class="total" id="m-x1"> 6 </p>


                                                                </div>
                                                            </li>
                                                            <!-- end one stars -->
                                                        </ol>
                                                    </div>
                                                    <!-- end full Rate -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end driver Rate -->

                                    </div>
                                </div>
                            </div>
                        </div>

            @endforeach
            @endisset


        @endsection
@section('js')

     <script>

         $('.showDetails').click(function(){
      $(`#order-date`).val('');
        var id= $(this).attr('data-id');
        $(`#order-model-id`).val(id);
             $.ajax({
                 type:'GET',
                 url:"{{route('admin.driverDetails')}}",
                 data:{
                     id:id,

                 },

                 success:function(res){
                     if(res['status']==true)
                     {
                         toastr.success('تم تنفيذ طلبك بنجاح')
                         $(`#m-wash`).text(res['normal']);
                         $(`#m-disinfect`).text(res['disinfect']);
                         $(`#m-polishing`).text(res['polishing']);
                         $(`#m-subscription`).text(res['subscription']);
                         $(`#m-totalOrder`).text(res['totalOrder']);
                         $(`#m-commission`).text(res['commission']);
                         $(`#m-order4x`).text(res['order_4x']);
                         $(`#m-commission4x`).text(res['commission_4x']);
                         $(`#m-order5x`).text(res['order_5x']);
                         $(`#m-commission5x`).text(res['commission_5x']);
                         $(`#m-x1`).text(res['x1']);
                         $(`#m-x2`).text(res['x2']);
                         $(`#m-x3`).text(res['x3']);
                         $(`#m-x4`).text(res['x4']);
                         $(`#m-x5`).text(res['x5']);
                         $(`#px1`).attr('style',`width: ${res['px1']}%`);
                         $(`#px2`).attr('style',`width: ${res['px2']}%`);
                         $(`#px3`).attr('style',`width: ${res['px3']}%`);
                         $(`#px4`).attr('style',`width: ${res['px4']}%`);
                         $(`#px5`).attr('style',`width: ${res['px5']}%`);
                         $(`#driverStatusLabel`).text(res['driver']['name']);


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
            url:"{{route('admin.driverDetailsByDate')}}",
            data:{
                id:id,
                date:date,
            },

            success:function(res){
                if(res['status']==true)
                {
                    toastr.success('تم تنفيذ طلبك بنجاح');
                    $(`#m-wash`).text(res['normal']);
                    $(`#m-disinfect`).text(res['disinfect']);
                    $(`#m-polishing`).text(res['polishing']);
                    $(`#m-subscription`).text(res['subscription']);
                    $(`#m-totalOrder`).text(res['totalOrder']);
                    $(`#m-commission`).text(res['commission']);
                    $(`#m-order4x`).text(res['order_4x']);
                    $(`#m-commission4x`).text(res['commission_4x']);
                    $(`#m-order5x`).text(res['order_5x']);
                    $(`#m-commission5x`).text(res['commission_5x']);
                    $(`#m-x1`).text(res['x1']);
                    $(`#m-x2`).text(res['x2']);
                    $(`#m-x3`).text(res['x3']);
                    $(`#m-x4`).text(res['x4']);
                    $(`#m-x5`).text(res['x5']);
                    $(`#px1`).attr('style',`width: ${res['px1']}%`);
                    $(`#px2`).attr('style',`width: ${res['px2']}%`);
                    $(`#px3`).attr('style',`width: ${res['px3']}%`);
                    $(`#px4`).attr('style',`width: ${res['px4']}%`);
                    $(`#px5`).attr('style',`width: ${res['px5']}%`);



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
<script>
    function convert(){
        window.print();
    }
</script>
@endsection
