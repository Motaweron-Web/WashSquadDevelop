@extends('admin.layouts.inc.app')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <button class="stoped" data-bs-toggle="modal" data-bs-target="#addNew">
                <i class="fas fa-plus me-2"></i>
                إضافة فاتورة
            </button>
        </div>
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2">
                <select class="form-select shadow-lg" id="changeFilter">
                    <option value="" disabled selected>إختر</option>
                    <option value="today" {{$request->filter=='today'?'selected':''}}>Today </option>
                    <option value="thisWeek" {{$request->filter=='thisWeek'?'selected':''}}>This week</option>
                    <option value="lastWeek" {{$request->filter=='lastWeek'?'selected':''}}>Last week</option>
                    <option value="lastMonth" {{$request->filter=='lastMonth'?'selected':''}}>Last month</option>
                    <option value="thisMonth" {{$request->filter=='thisMonth'?'selected':''}}>This month</option>
                    <option value="lastYear" {{$request->filter=='lastYear'?'selected':''}}>Last year</option>
                    <option value="thisYear" {{$request->filter=='thisYear'?'selected':''}}>This year</option>
                </select>
            </div>
            <div class="p-2">
                <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

            </div>
            <div class="p-2">
                <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    <!-- logs -->
    <section class="logs">
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> عدد الطلبات </h5>
            <h4> {{\App\Models\Order::count()}} </h4>
        </div>
        @foreach(\App\Models\Service::where('level',1)->get() as $service)
            <div class="singleLog flex-column ">
                <h5>  {{$service->ar_title}} </h5>
                <h4>{{\App\Models\Order::where('service_id',$service->id)->count()}} </h4>
            </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        @foreach(\App\Models\Service::where('level',1)->get() as $service)

        <div class="singleLog flex-column ">
            <h5> ايراد {{$service->ar_title}} </h5>
            <h4> {{\App\Models\Order::where('service_id',$service->id)->sum('total_price')}} </h4>
        </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> الايرادات </h5>
            <h4> {{\App\Models\Order::sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        @foreach(\App\Models\Payment::get() as $payment)
        <div class="singleLog flex-column active ">
            <h5> {{$payment->type}} </h5>
            <h4> {{\App\Models\Order::where('payment_method',$payment->id)->sum('total_price')}}  </h4>
        </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> اولاين تطبيقات </h5>
            <h4> {{\App\Models\Order::where('distributor_employee_id','!=',NULL)->sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column gray">
            <h5> العمولة </h5>
            <h4> {{\App\Models\Order::sum('commission_value')}} </h4>
        </div>
        <!-- end single log -->
    </section>
    <div class="d-flex flex-wrap justify-content-end align-items-center ">
        <div class="d-flex flex-wrap justify-content-end ">
            <div class="p-2">
                <select id="choseCar"  class="form-select shadow-lg">
                    <option selected disabled > السيارة  </option>
                    @foreach(\App\Models\User::where('user_type',2)->get() as $driver)
                        <option value="{{$driver->id}}" @isset($car)   @if($car==$driver)  selected   @endif   @endisset> {{$driver->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    <section class="drivers">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> كود السائق </th>
                    <th> تاريخ الطلب </th>
                    <th> المسوق </th>
                    <th> العدد </th>
                    <th> نوع الخدمة </th>
                    <th> الباقة </th>
                    <th> خدمة اضافة </th>
                    <th> رقم الجوال </th>
                    <th> الاجمالي </th>
                    <th> المكافأة الفورية </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
              @foreach($orders as $order)
                <tr>
                    <td> {{$order->driver->id}} </td>
                    <td> {{$order->date}}</td>
                    <td> {{$order->user->full_name}} </td>
                    <td> {{$order->number_of_cars}} </td>
                    <td> {{$order->service->ar_title}} </td>
                    <td>{{$order->sub_service->ar_title ??''}} </td>
                    <td>

                        @foreach($order->sub_sub_services as $index=> $service)
                            @if($index==0)
                                {{$service->ar_title}}
                            @else
                                -       {{$service->ar_title}}

                            @endif
                        @endforeach

                    </td>
                    <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>
                    <td> {{$order->total_price}}</td>
                    <td> 1500 </td>
                    <td> {{$order->payment->type}} </td>
                    <td>
                        <select class="form-select">
                            <option value="1" selected> لم يعتمد </option>
                            <option value="2"> تم الاعتماد </option>
                        </select>
                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="#!" class="edit" data-bs-toggle="modal" data-bs-target="#edit">
                                <i class="fas fa-edit"></i> </a>
                        </div>
                    </td>
                </tr>
              @endforeach
                </tbody>
            </table>
{!! $orders->links() !!}
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="edit" tabindex="-1" aria-labelledby="editLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel"> +966542188234 </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="edit">
                        <div class="mb-3">
                            <label class="form-label"> ملاحظات العمليات </label>
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <div class="row">
                            <label class="form-label"> عدد السيارات </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="number">
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> رصيد المحفظة </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100"> اضافة </button>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> مكافاءات فورية </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100"> اضافة </button>
                            </div>
                        </div>
                        <div class="my-4">
                            <label class="form-label mb-4 "> طريقة الدفع </label>
                            <div class="d-flex align-items-center ">
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay1"
                                           value="option1">
                                    <label class="form-check-label" for="pay1">
                                        كاش
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay2"
                                           value="option2">
                                    <label class="form-check-label" for="pay2">
                                        Stcpay
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay3"
                                           value="option3">
                                    <label class="form-check-label" for="pay3">
                                        شبكة
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay4"
                                           value="option4">
                                    <label class="form-check-label" for="pay4">
                                        تحويل بنكي
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay5"
                                           value="option5">
                                    <label class="form-check-label" for="pay5">
                                        ابل بي
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay6"
                                           value="option6">
                                    <label class="form-check-label" for="pay6">
                                        اولاين تطبيقات
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn"> حفظ و إغلاق </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="addNew" tabindex="-1"
         aria-labelledby="addNewLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel"> إضافة فاتورة جديدة </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="addNew">

                        <div class="row">
                            <div class="col-6 p-2">
                                <label class="form-label"> كود السائق </label>
                                <select class="form-select ">
                                    <option selected disabled> اختر  </option>
                                    <option value="1">2021</option>
                                    <option value="2">2020</option>
                                    <option value="3">2019</option>
                                </select>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> تاريخ الطلب </label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> نوع الخدمة </label>
                                <select class="form-select ">
                                    <option selected disabled> اختر  </option>
                                    <option value="1">2021</option>
                                    <option value="2">2020</option>
                                    <option value="3">2019</option>
                                </select>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> رقم الجوال </label>
                                <input class="form-control" type="number">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> عدد السيارات </label>
                                <input class="form-control" type="number">

                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> مكافاءات فورية </label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-12 p-2">
                                <label class="form-label"> الاجمالي </label>
                                <input class="form-control" type="text">
                            </div>

                            <div class="col-6 p-2">
                                <label class="form-label mb-4 "> طريقة الدفع </label>
                                <div class="d-flex  flex-column ">
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay1"
                                               value="option1">
                                        <label class="form-check-label" for="pay1">
                                            كاش
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay2"
                                               value="option2">
                                        <label class="form-check-label" for="pay2">
                                            Stcpay
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay3"
                                               value="option3">
                                        <label class="form-check-label" for="pay3">
                                            شبكة
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay4"
                                               value="option4">
                                        <label class="form-check-label" for="pay4">
                                            تحويل بنكي
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay5"
                                               value="option5">
                                        <label class="form-check-label" for="pay5">
                                            ابل بي
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay6"
                                               value="option6">
                                        <label class="form-check-label" for="pay6">
                                            اولاين تطبيقات
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label  mb-4 "> الخدمات الاضافية </label>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service1">
                                    <label class="form-check-label" for="service1">
                                        تلميع مكينة
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service2">
                                    <label class="form-check-label" for="service2">
                                        تلميع جنوط
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service3">
                                    <label class="form-check-label" for="service3">
                                        تعطير السيارة
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service4">
                                    <label class="form-check-label" for="service4">
                                        تلبيس الدعسات
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service5">
                                    <label class="form-check-label" for="service5">
                                        تلميع كرسي أطفال
                                    </label>
                                </div>

                            </div>

                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn"> حفظ و إغلاق </button>
                </div>
            </div>
        </div>
    </div>




@endsection


@section('js')
<script>
    $('#choseCar').on('keyup keydown change', function(){
        var oldUrl=window.location.href;
        var date=oldUrl.split('?')[1];
    var val = $(this).val();
    var myUrl = "{{route('admin.revenue.search.car',':car')}}";
    var string = val;
        var all=val+'?'+date;

        myUrl = myUrl.replace(':car',all);
    window.location = myUrl
    window.location = myUrl
    });
</script>
<script>

    $('#changeFilter').on('change',function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.cars.revenue')}}?month={{date('Y-m')}}&type=filter&filter="+val
        window.location = myUrl
    });
    $('#choseMonth').on('keyup keydown change', function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.cars.revenue')}}?month="+val+"&type=month";
        window.location = myUrl
    });

</script>

    <script>
        $(function(){
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month ;
            $('#choseMonth').attr('max', maxDate);
        });
    </script>
@endsection
