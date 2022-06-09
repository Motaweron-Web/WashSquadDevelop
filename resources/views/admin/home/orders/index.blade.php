@extends('admin.layouts.inc.app')

@section('content')


    <div class="container-fluid">
        <!-- date -->
        <div id="pdf">
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
                    <input type="month" class="form-control"  id="choseMonth" value="{{$request->month}}">

                </div>
                <div class="p-2">
                    <a href="javascript:genScreenshot()" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export PDF
                    </a>
                </div>
            </div>

            <!-- drivers -->
        <div class=" apps drivers  mb-4">
            <div class="row">
                @foreach($orders as $order )
                <div class="col-md-3 col-sm-6 p-2">
                    <div class="contents">
                        <div class="d-flex justify-content-between align-items-center">
                         @if($order->status==1)
                                <button class="working-comp">  جديد </button>
                            @elseif($order->status==2)
                                <button class="working-comp"> جاري العمل </button>
                            @elseif($order->status==3)
                                <button class="stoped">تم </button>

                            @elseif($order->status==5)
                                 <button class="canceled"> تم الالفاء </button>
                             @else
                                <button class="canceled">  منك للة </button>

                            @endif
                            <h5 class="mb-0 driver-serial"> {{$order->driver->id}} </h5>
                        </div>
                        <div class="timer d-flex align-items-center mx-auto justify-content-center my-3">
                            <div class="circle text-center">
                                <div class="timer-data">
                                    <p class="mb-1"> Timer </p>
                                    <span class="timer-span timer" id="{{$order->id}}"> {{$order->timer}} </span>
                                </div>
                            </div>
                        </div>
                        <div class="car-details d-flex align-items-center justify-content-center">
                            <h6 class=" px-2 d-inline-block"> {{$order->service->ar_title}} </h6>

                        </div>
                        <div class="gps py-2">
                            <h6 class="text-center"> {{$order->address}} </h6>
                        </div>
                    </div>
                </div>
                  @endforeach
            </div>

{{--            {!! $orders->render()!!}--}}

                <!-- table row -->
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table ">
                        <thead>
                        <tr>
                            <th> كود السائق </th>
                            <th> الحالة </th>
                            <th> رقم الطلب </th>
                            <th> Go </th>
                            <th> Start </th>
                            <th> Done </th>
                            <th> Finish </th>
                            <th> Time </th>
                            <th> المبلغ </th>
                            <th> التقييم </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td > {{$order->id}} </td>
                            <td>

                                @if($order->status==1)
                                    <button class="working-comp">  جديد </button>
                                @elseif($order->status==2)
                                    <button class="working-comp"> جاري العمل </button>
                                @elseif($order->status==3)
                                    <button class="stoped">تم </button>

                                @elseif($order->status==5)
                                    <button class="canceled"> تم الالفاء </button>
                                @else
                                    <button class="canceled">  منك للة </button>

                                @endif

                            </td>
                            <td> {{$order->id}} </td>

                            <td>  @if($order->status==2)
                                    {{$order->go}}
                                    @else -  @endif </td>

                            <td>  @if($order->status==2)
                                    {{$order->start_date}}
                                @else -  @endif </td>

                            <td>  @if($order->status==2)
                                    {{$order->done_date}}
                                @else -  @endif </td>

                            <td>  @if($order->status==2)
                                    {{$order->finish_date}}
                                @else -  @endif </td>

                            <td>  @if($order->status==2)
                                    {{$order->timer}}

                                @else -  @endif </td>

                            <td> {{$order->total_price}} sr </td>

                            <td> <span>  @if($order->status==2)
                                        {{$order->rating}}

                                    @else -  @endif</span> </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

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
    // show(129,'2022-06-08 14:10:15');
    // show(130,'2022-06-08 20:10:15');
    // show(132,'2022-06-08 20:10:15');
    // show(133,);

    @foreach($orders as $order )
       @if($order->status==2)
        show({{$order->id}},"{{$order->start_date}}");
        @endif
    @endforeach


    function show(id,date){
            var time=new Date(date).getTime();
            setInterval(function (){


                var now=new Date().getTime();
                var distance=  now - time  ;

                //
                // var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
                // var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
                // var seconds=Math.floor((distance%(1000*60))/1000);
                //

                const second=1000;
                const minute=second*60;
                const hour=minute*60;
                const day=hour*24;

                const textday=Math.floor(distance/day);
                const texthour=Math.floor((distance % day )/hour);

                const textminute=Math.floor((distance % hour )/minute);

                const textsecond=Math.floor((distance % minute )/second);










                document.getElementById(id).innerHTML=textday +'d '   + texthour +'h '+textminute +'m '+textsecond +'s ';


            },1000);

        }
    </script>

            <script>


                $('#changeFilter').on('change',function(){
                    var val = $(this).val();
                    var myUrl = "{{route('getdriverorder')}}?month={{date('Y-m')}}&type=filter&filter="+val
                    // window.location = myUrl
                });
                $('#choseMonth').on('keyup keydown change', function(){
                    var val = $(this).val();
                    var myUrl = "{{route('getdriverorder')}}?month="+val+"&type=month";
                    // window.location = myUrl
                });
            </script>
@endsection
