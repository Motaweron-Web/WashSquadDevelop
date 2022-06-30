@extends('admin.layouts.inc.app')
@section('class')
    monthly_subscription-table operation monthly-subscription
@endsection
@section('css')
    @include('admin.layouts.loaders.assets.formLoader')
    <link href="{{url('assets/admin')}}/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
    <!-- Plugins css -->
    <link href="{{url('assets/admin')}}/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{url('assets/admin')}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/admin')}}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
          type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css" />
    <!-- Plugin css -->
    <style>
        .calendarHead {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: 13.7% 13.7% 13.7% 13.7% 13.7% 13.7% 13.7%;
            grid-template-columns: 13.7% 13.7% 13.7% 13.7% 13.7% 13.7% 13.7%;
            grid-column-gap: .6%;
            grid-row-gap: 1.2%;
            margin: 20px 0;
        }
        .calendarHead .day {
            padding: 10px;
            border-right: 1px solid #3F0033;
            font-size: larger;
            font-weight: bold;
        }
        .calendarBody .day,.calendarHead .day {
            padding: 15px 10px 10px;
            text-align: center;
        }
        .toDay .day-div{
            box-shadow: 0px 4px 16px #000000!important;
        }
        .active .day-div{
            background-color: #00000010!important;
        }

    </style>
@endsection


@section('content')

    <!-- date -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <button class="stoped" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                <i class="fas fa-plus me-2"></i>
                إضافة طلب
            </button>
        </div>
        <div class="d-flex flex-wrap justify-content-end align-items-center mb-3">

            <div class="p-2">
                <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

            </div>
        </div>
    </div>

    <div class="calendarHead">
        <div class="day">Sat</div>
        <div class="day">Fri</div>
        <div class="day">Thu</div>
        <div class="day">Wed</div>
        <div class="day">Tue</div>
        <div class="day">Mon</div>

        <div class="day">Sun</div>
    </div>
    <div class="calender ">
        <?php
        $i = 1;
        $flag = 0;
        while ($i <= $number_of_day) {
            for($j=1 ; $j<=7 ; $j++){
                if($i > $number_of_day)
                    break;

                if($flag) {
                    if ($year . '-' . $month . '-' . $i == date('Y') . '-' . date('m') . '-' . (int)date('d'))
                        include(resource_path('views/admin/monthly_subscription/parts/toDay.php'));
                    else
                        include(resource_path('views/admin/monthly_subscription/parts/day.php'));

                    $i++;
                }elseif($j == $start_day){
                    if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                        include(resource_path('views/admin/monthly_subscription/parts/toDay.php'));
                    else
                        include(resource_path('views/admin/monthly_subscription/parts/day.php'));

                    $flag = 1;
                    $i++;
                    continue;
                }
                else {
                    include(resource_path('views/admin/monthly_subscription/parts/prevMonth.php'));
                }

            }
        }
        ?>

    </div>


    <div class="table-rep-plugin">
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table dt-responsive nowrap">
                <thead>
                <tr>
                    <th> رقم الطلب </th>
                    <th> تاريخ الطلب </th>
                    <th> الوقت </th>
                    <th> المزود </th>
                    <th> العدد </th>
                    <th> نوع الخدمة </th>
                    <th> الباقة </th>
                    <th> خدمة إضافة </th>
                    <th> الحي </th>
                    <th> إسم العميل </th>
                    <th> رقم الجوال </th>
                    <th> الماركة </th>
                    <th> الإجمالي </th>
                    <th> الموقع </th>
                    <th> فاتورة </th>
                    <th></th>
                </tr>
                </thead>

{{--                <tbody >--}}
{{--                <tr>--}}
{{--                    <td> {{$order->driver->id}} </td>--}}
{{--                    <td> {{$order->date}}</td>--}}
{{--                    <td> {{$order->user->full_name}} </td>--}}
{{--                    <td>--}}

{{--                        @foreach($order->sub_sub_services as $index=> $service)--}}
{{--                            @if($index==0)--}}
{{--                                {{$service->ar_title}}--}}
{{--                            @else--}}
{{--                                -       {{$service->ar_title}}--}}

{{--                            @endif--}}
{{--                        @endforeach--}}

{{--                    </td>--}}
{{--                    <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>--}}
{{--                    <td> {{$order->total_price}}</td>--}}
{{--                    <td> 1500 </td>--}}
{{--                    <td> {{$order->payment->type}} </td>--}}
{{--                    <td>--}}
{{--                        <select class="form-select">--}}
{{--                            <option value="1" selected> لم يعتمد </option>--}}
{{--                            <option value="2"> تم الاعتماد </option>--}}
{{--                        </select>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="actionsIcons">--}}
{{--                            <a href="#!" class="edit" data-bs-toggle="modal" data-bs-target="#edit">--}}
{{--                                <i class="fas fa-edit"></i> </a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                @foreach($orders  as $order)--}}
{{--                    <tr>--}}
{{--                        <td> {{$order->id}} </td>--}}
{{--                        <td> {{$order->date}} </td>--}}
{{--                        <td> {{$order->order_time}} </td>--}}
{{--                        <td>  </td>--}}
{{--                        <td> {{$order->number_of_cars}} </td>--}}
{{--                        <td> {{$order->service->ar_title}} </td>--}}
{{--                        <td> اشتراك </td>--}}
{{--                        <td> تلميع مكينة </td>--}}
{{--                        <td> الروضة </td>--}}
{{--                        <td> محمد </td>--}}
{{--                        <td> 0586877977 </td>--}}
{{--                        <td> مازدا </td>--}}
{{--                        <td> 250SR </td>--}}
{{--                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"--}}
{{--                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i> </a>--}}
{{--                        </td>--}}
{{--                        <td> <a href=""> <i class="fas fa-file-pdf"></i> </a> </td>--}}
{{--                        <td> <a class="sub-details" href="" data-bs-toggle="modal"--}}
{{--                                data-bs-target="#subsc-detail"> تفاصيل الإشتراك </a> </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
            </table>
        </div>
    </div>
    <!-- Add New Event MODAL -->
    <div class="modal fade" id="subscriptionModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3 px-4">
                    <!-- <h5 class="modal-title" id="modal-title"> إضافة  </h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="subscriptionContent">

                </div>
                <div class="modal-footer">
                    <div class="w-100 d-flex justify-content-between">
                        <button type="button" class="btn stoped  mx-2" data-bs-dismiss="modal"> إلغاء
                        </button>
                    </div>
                </div>
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal dialog-->
    </div>
    <!-- end modal-->
    <!-- modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mod-content">
                        <form  action="{{route('admin.add.participation')}}" id="add-subscription">
{{--                            <div action="#" class="dropzone">--}}
{{--                                <div class="fallback">--}}
{{--                                    <input name="file" type="file">--}}
{{--                                </div>--}}
{{--                                <div class="dz-message needsclick">--}}
{{--                                    <div class="">--}}
{{--                                        <i class="display-6 fas mo-icon fa-user"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row pt-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> إسم العميل
                                        </label>
                                        <input class="form-control"  name="full_name" type="text" id="a-full_name"
                                               placeholder="بكري">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input">رقم الجوال</label>
                                        <input class="form-control" name="phone" type="number" id="a-phone"
                                               placeholder="213243">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> الحي </label>
                                        <select class="form-select mo-form-select" name="place_id" id="d_selectPlaceId">
                                            <option   disabled selected>الحي</option>
                                            @foreach(\App\Models\Place::get() as $place)
                                                <option value="{{$place->id}}">{{$place->ar_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> فترة الطلب </label>
                                       <input class="form-control" type="time" name="order_time" id="a-order_time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> نوع الباقة
                                        </label>
                                        <select  class="form-select mo-form-select" name="service_id" id="d_selectServiceId">
                                            <option disabled selected>اختر الباقة</option>

                                        @foreach(\App\Models\Service::where('level',2)->where('parent_id',77)->get() as $service)
                                            <option value="{{$service->id}}">{{$service->ar_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> وسيلة الدفع</label>
                                        <select class="form-select mo-form-select" name="payment_id" id="a-payment_id">
                                            <option value="" disabled> وسيلة الدفع </option>
                                            @foreach(\App\Models\Payment::get() as $payment)
                                                <option value="{{$payment->id}}" > {{$payment->type}}  </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> ماركة السيارة
                                        </label>
                                        <select  class="form-select mo-form-select" name="car_type1" id="d_selectCarType">
                                            <option disabled selected>اختر الماركة </option>
                                            @foreach(\App\Models\CarType::where('level',1)->get() as $car)

                                                <option value="{{$car->id}}">{{$car->ar_title}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> الفئة </label>
                                        <select  class="form-select mo-form-select" name="car_type2" id="d_sub_type_id">
                                            <option disabled selected>اختر الماركة </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> لوحة السيارة </label>
                                        <input class="form-control" name="car_blade_number" type="number" id="a-car_blade_number"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input" id=""> اليوم </label>
                                        <select class="form-select mo-form-select" name="day" id="d_day">
                                            <option value="">اليوم(اختر الباقة اولا)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> الاجمالي </label>
                                        <input class="form-control" type="number" id="default-input"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <div class="w-100 d-flex justify-content-end">
                                    <button type="submit" class="btn orangeBtn px-5 "> أضف </button>
                                    <button type="button" class="btn mainBtn px-5  mx-2" data-bs-dismiss="modal"> إلغاء </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('js')
    @include('admin.monthly_subscription.assets.js')
    <script>
    $('#d_selectCarType').on('change', function() {
        var id = this.value;
        $(`#d_sub_type_id`).html(' <option value=""  disabled>إختر الماركة أولا</option>');

        $.ajax({
            type: 'GET',
            url: "{{route('getsubcarbymaincar')}}",
            data: {
                id: id,
            },

            success: function (res) {
                if (res['status'] == true) {

                    var cartypes = ``;
                    var default_value=` <option disabled selected>اختر الفئة الان  </option>`;
                    $(`#d_sub_type_id`).html();
                    $(`#d_sub_type_id`).html(default_value);

                    for (var i = 0; i < res['cars'].length; i++) {
                        cartypes = `<option value="${res['cars'][i]['id']}">${res['cars'][i]['ar_title']}</option>`;
                        $(`#d_sub_type_id`).append(cartypes);

                    }

                } else if (res['status'] == false)
                    location.reload();


            },
            error: function (data) {
                alert('error');
            }
        });
    });
</script>

    <script>



        $('#d_selectPlaceId').on('change', function() {
            var id = this.value;
            $(`#d_day`).html(' <option value=""  disabled>إختر الماركة أولا</option>');

            $.ajax({
                type: 'GET',
                url: "{{route('admin.participation.day')}}",
                data: {
                    id: id,
                },

                success: function (res) {
                    if (res['status'] == true) {
                        var cartypes = ``;
                        $(`#d_day`).html();

                        for (var i = 0; i < res['days'].length; i++) {
                            cartypes = `<option value="${res['days'][i]}">${res['days'][i]}</option>`;
                            $(`#d_day`).append(cartypes);

                        }

                    } else if (res['status'] == false)
                        location.reload();


                },
                error: function (data) {
                    toastr.error('عفوا هذا الحي ليس مدرج ف قائمة الخدمات');
                }
            });
        });
    </script>












    <script>

        $('#add-subscription').on('submit',(function(e) {
            e.preventDefault();

            var full_name=$('#a-full_name').val();
            var phone=$('#a-phone').val();
            var place_id=$('#d_selectPlaceId').val();
            var order_time=$('#a-order_time').val();
            var service_id=$('#d_selectServiceId').val();
            var payment_id=$('#a-payment_id').val();
            var car_type1=$('#d_selectCarType').val();
            var car_type2=$('#d_sub_type_id').val();
            var  car_blade_number=$('#a-car_blade_number').val();
            var day=$('#d_day').val();

            $.ajax({
                type: 'get',
                url: "{{route('admin.add.participation')}}",
                data: {

                    full_name:full_name,
                    phone:phone,
                    place_id:place_id,
                    order_time:order_time,
                    service_id:service_id,
                    payment_id:payment_id,
                    car_type1:car_type1,
                    car_type2:car_type2,
                    car_blade_number:car_blade_number,
                    day:day
                },

                success: function (res) {

                    if (res['status'] == true) {
                        $('#exampleModalScrollable').modal('toggle');
                        toastr.success('تم اضافة طلبك بنجاح');


                    } else if (res['status'] == 'error') {
                toastr.error('يرجي التاكد من البيانات');
                    }
                    else
                        toastr.success('يرجي التاكد من ');
                },
                error: function (data) {
                    toastr.error('يرجي التاكد من البيانات');
                }
            });
        }));


    </script>






@endsection
