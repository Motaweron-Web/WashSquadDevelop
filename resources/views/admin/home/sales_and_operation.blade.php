@extends('admin.layouts.inc.app')
@section('class')
    sales
@endsection
@section('content')
<div id="pdf">
    <!-- date -->
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
            <a href="javascript:genScreenshot()" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export PDF
            </a>
        </div>
    </div>
    <!-- start page title -->
    <!-- <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Responsive Tables</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Responsive Tables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- end page title -->
    <div class="row mb-3">
        <div class="col-md-2 p-2">
            <div class="date">
                <p class="mb-0"> اليوم </p>
            </div>
        </div>
        <div class="col-md-10 p-2">
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th> التارجت المطلوب </th>
                            <th> التارجت المحقق </th>
                            <th> التارجت المتبقي </th>
                            <th> نسبة الملغي </th>
                            <th> نسبة المكتمل </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @php
                                $totalToday =  App\Models\Order::whereDate("date",date("Y-m-d"))->count();
                                $cancel = 0 ;
                                $cancelCount = App\Models\Order::whereDate("date",date("Y-m-d"))
                                                        ->whereIn('status',[5,6,7])->count() ;
                                if($cancelCount !=null){
                                  $cancel = 0;
                                }
                                //=============================================
                                $complete = 0 ;
                                $completeCount =  App\Models\Order::whereDate("date",date("Y-m-d"))
                                                            ->whereIn('status',[3,4])->count();
                                if($completeCount !=null){
                                  $complete = 0;
                                }
                                 //=============================================
                                 /*$target = 0 ;
                                 $targetCount =  App\Models\Order::where("order_date",strtotime(date("Y-m-d")))
                                                      ->whereIn('status',[-1,0,2])->count();
                                if($targetCount !=null){
                                  $target = $targetCount ;
                                }*/
                                 //=============================================
                            @endphp
                            <td> <input type="text" class="form-control saleInput" data-id="{{$setting->id}}" id="target_value" data-name="target" value="{{$setting->target}}"></td>
                            <td id="target_finish">{{App\Models\Order::whereDate("date",date("Y-m-d"))->sum('total_price')}}</td>
                            <td id="target_remain"></td>
                            <td>{{$cancel}} </td>
                            <td>{{$complete}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row mb-3">
        <div class="col-md-2 p-2">
            <div class="date">
                <p class="mb-0"> الشهر </p>
            </div>
        </div>
        <div class="col-md-10 p-2">
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th> التارجت المطلوب </th>
                            <th> التارجت المحقق </th>
                            <th> التارجت المتبقي </th>
                            <th> نسبة الملغي </th>
                            <th> نسبة المكتمل </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @php

                                $from = date("Y-m").'-01';
                                $to = date("Y-m-t");
                                $betweenMonth = [$from,$to];

                                $totalToday =  App\Models\Order::whereBetween("date",$betweenMonth)->count();
                                $cancel = 0 ;
                                $cancelCount = App\Models\Order::whereBetween("date",$betweenMonth)
                                                        ->whereIn('status',[5,6,7])->count() ;
                                if($cancelCount !=null){
                                  $cancel = 0;
                                }
                                //=============================================
                                $complete = 0 ;
                                $completeCount =  App\Models\Order::whereBetween("date",$betweenMonth)
                                                            ->whereIn('status',[3,4])->count();
                                if($completeCount !=null){
                                  $complete = 0 ;
                                }
                                 //=============================================
                                 /*$target = 0 ;
                                 $targetCount =  App\Models\Order::where("date",strtotime(date("Y-m-d")))
                                                      ->whereIn('status',[-1,0,2])->count();
                                if($targetCount !=null){
                                  $target = $targetCount ;
                                }*/
                                 //=============================================
                            @endphp
                            <td> <input type="text" class="form-control saleInput" data-id="{{$setting->id}}" id="target_month_value" data-name="target_month" value="{{$setting->target_month}}"></td>
                            <td id="target_month_finish">{{App\Models\Order::whereBetween("date",$betweenMonth)->sum('total_price')}}</td>
                            <td id="target_month_remain"></td>
                            <td>{{$cancel}} </td>
                            <td>{{$complete}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row mb-3">
        <div class="col-md-2 p-2">
            <div class="date">
                <p class="mb-0"> السنة </p>
            </div>
        </div>
        <div class="col-md-10 p-2">
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th> التارجت المطلوب </th>
                            <th> التارجت المحقق </th>
                            <th> التارجت المتبقي </th>
                            <th> نسبة الملغي </th>
                            <th> نسبة المكتمل </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @php

                                $from = date("Y").'-01-01';
                                 $to = date("Y").'-12-'.date('t',strtotime('2022-12-01'));
                                $betweenYear = [$from,$to];

                                $totalToday =  App\Models\Order::whereBetween("date",$betweenYear)->count();
                                $cancel = 0 ;
                                $cancelCount = App\Models\Order::whereBetween("date",$betweenYear)
                                                        ->whereIn('status',[5,6,7])->count() ;
                                if($cancelCount !=null){
                                  $cancel = 0;
                                }
                                //=============================================
                                $complete = 0 ;
                                $completeCount =  App\Models\Order::whereBetween("date",$betweenYear)
                                                            ->whereIn('status',[3,4])->count();
                                if($completeCount !=null){
                                  $complete = 0 ;
                                }
                                 //=============================================
                                 /*$target = 0 ;
                                 $targetCount =  App\Models\Order::where("date",strtotime(date("Y-m-d")))
                                                      ->whereIn('status',[-1,0,2])->count();
                                if($targetCount !=null){
                                  $target = $targetCount ;
                                }*/
                                 //=============================================
                            @endphp
                            <td> <input type="text" class="form-control saleInput" data-id="{{$setting->id}}" id="target_year_value" data-name="target_year" value="{{$setting->target_year}}"></td>
                            <td id="target_year_finish">{{App\Models\Order::whereBetween("date",$betweenYear)->sum('total_price')}}</td>
                            <td id="target_year_remain"></td>
                            <td>{{$cancel}} </td>
                            <td>{{$complete}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <!-- orders -->
    <div class="row mb-3">
        <div class="col-12 ">
            <p class="fw-bold"> الطلبات </p>
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th> اجمالي الطلبات المستلمة </th>
                            <th> اجمالي الطلبات جاري </th>
                            <th> اجمالي الطلبات ملغي </th>
                            <th> اجمالي الطلبات تمت الخدمة </th>
                            <th> اجمالي الطلبات قيد الانتظار </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$orderData['orders_received']}}</td>
                            <td>{{$orderData['orders_inProgress']}}</td>
                            <td>{{$orderData['orders_cancel']}}</td>
                            <td>{{$orderData['orders_ended']}}</td>
                            <td>{{$orderData['orders_inProgress']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
{{--    <!-- sales -->--}}
{{--    <div class="row mb-3">--}}
{{--        <div class="col-12 ">--}}
{{--            <p class="fw-bold"> المبيعات </p>--}}
{{--            <div class="table-rep-plugin shadow">--}}
{{--                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">--}}
{{--                    <table class="table tableBG">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>المبيعات المستلمة</th>--}}
{{--                            <th>المبيعات غير الموزعة</th>--}}
{{--                            <th>المبيعات الموزعة</th>--}}
{{--                            <th> الضريبه للمبيعات الموزعة</th>--}}
{{--                            <th>المبيعات الموزعة بعد الضريبه</th>--}}
{{--                            <th>مبيعات المسوقين</th>--}}
{{--                            <th>مبيعات التطبيق</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>100</td>--}}
{{--                            <td>20</td>--}}
{{--                            <td>100</td>--}}
{{--                            <td>100</td>--}}
{{--                            <td>100</td>--}}
{{--                            <td>100</td>--}}
{{--                            <td>100</td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div> <!-- end col -->--}}
{{--    </div>--}}
{{--    <!-- end row -->--}}
    <!-- pay -->
    <div class="row mb-3">
        <div class="col-12 ">
            <p class="fw-bold"> التحصيل المالي </p>
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th>الكاش</th>
                            <th>نقاط البيع</th>
                            <th>اونلاين</th>
                            <th>تحويل بنكي</th>
                            <th>لم يتم الدفع</th>
                            <th>مجاني</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$orderMoney['cash']}}</td>
                            <td>{{$orderMoney['pos']}}</td>
                            <td>{{$orderMoney['online']}}</td>
                            <td>{{$orderMoney['not_paid']}}</td>
                            <td>{{$orderMoney['not_paid']}}</td>
                            <td><input type="number" class="form-control saleInput" value="1"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <!-- cars turn on -->
    <div class="row mb-3">

        <div class="col-md-6 ">
            <p class="fw-bold"> تشغيل السيارات </p>
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th>السائق</th>
                            <th>الطلبات</th>
                            <th>المبيعات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(App\Models\User::where('user_type',2)->get() as $driver)
                            <tr class="text-center ">
                                <td>{{$driver->name}}</td>
                                <td>{{App\Models\Order::wherebetween("date",$betweenMonth)->where('driver_id',$driver->id)->where("payment_method",1)->count()}} </td>
                                <td>{{App\Models\Order::wherebetween("date",$betweenMonth)->where('driver_id',$driver->id)->where("payment_method",1)->sum('total_price')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-6 p-2 ">
            <p class="fw-bold"> مبيعات التطبيقات</p>
            <div class="table-rep-plugin shadow">
                <div class="table-responsive mb-0 rounded " data-pattern="priority-columns">
                    <table class="table tableBG">
                        <thead>
                        <tr>
                            <th>التطبيق</th>
                            <th>الطلبات</th>
                            <th>المبيعات</th>
                        </tr>
                        </thead>
                        <tbody>
                   @foreach($orders as $order)
                        <tr>
                            <td>{{($order->service_basic->ar_title)??'--'}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->price}}</td>
                        </tr>
                   @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- cars turn on -->

    </div>
    <!-- end row -->

</div>

@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function genScreenshot() {
            html2canvas(document.body, {
                onrendered: function(canvas) {
                    $('#pdf').html("");
                    $('#pdf').append(canvas);

                    if (navigator.userAgent.indexOf("MSIE ") > 0 ||
                        navigator.userAgent.match(/Trident.*rv\:11\./))
                    {
                        var blob = canvas.msToBlob();

                        window.navigator.msSaveBlob(blob,'Test file.png');

                    }
                    else   {

                        $('#pdf').attr('href', canvas.toDataURL("image/png"));
                        doc = new jsPDF({
                            unit: 'px',
                            format: 'a4'
                        });
                        doc.addImage(canvas.toDataURL("image/png"), 'JPEG', 0, 0);
                        doc.save('ExportFile.pdf');
                        form.width(cache_width);
                        //$('#test').attr('download','Test file.png');
                        $('#pdf')[0].click();
                    }


                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $(".saleInput").on('keyup', function () {
                var obj = $(this);
                var name = $(this).data('name');
                var val = obj.val() || 0;
                var id = obj.attr("data-id") || 0;
                var url = '{{ route("admin.update_target_setting") }}?'+name+'='+val;
                $.ajax({
                    type: 'post',
                    url: url,
                    data: { id: id},
                    dataType: 'html',
                    cache: false,
                    success: function (html) {
                        console.log(200);
                    },
                    error: function (error) {
                        console.log(500);
                        console.log(error.responseText);
                    }
                });
                //====================================
                var target_finish = parseFloat($("#"+name+"_finish").text()) || 0;

                var target_remain = val - target_finish;
                $("#"+name+"_remain").text(target_remain)
            })

            $('.saleInput').each(function(e){
                var name = $(this).data('name')
                var target_value = $("#"+name+"_value").val();
                var target_finish = parseFloat($("#"+name+"_finish").text()) || 0;
                var target_remain = target_value - target_finish;
                $("#"+name+"_remain").text(target_remain);
            })
        });
        $('#changeFilter').on('change',function(){
           var val = $(this).val();
           var myUrl = "{{route('admin.sales_and_operation')}}?month={{date('Y-m')}}&type=filter&filter="+val
            window.location = myUrl
        });
        $('#choseMonth').on('keyup keydown change', function(){
           var val = $(this).val();
           var myUrl = "{{route('admin.sales_and_operation')}}?month="+val+"&type=month";
            window.location = myUrl
        });
    </script>

@endsection
