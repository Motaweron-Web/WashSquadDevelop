@extends('admin.layouts.inc.app')

@section('js')

    <!-- apexcharts js -->
    <script src="{{url('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>


    <script>
        function convert(){
            window.print();
        }
        function genScreenshot() {
            html2canvas($('#pdf'), {
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

        $('#changeFilter').on('change',function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.dashboard')}}?month={{date('Y-m')}}&type=filter&filter="+val
            window.location = myUrl
        });
        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.dashboard')}}?month="+val+"&type=month";
            window.location = myUrl
        });
    </script>
    <script>
        <script>
            var options = {
            series: [{
            name: 'Order',
            data: [900, 430]
        }],
            chart: {
            type: 'bar',
            height: 200
        },
            plotOptions: {
            bar: {
            borderRadius: 400,
            horizontal: true,
        }
        },
            fill: {
            colors: ['#400034']
        },
            dataLabels: {
            enabled: false
        },
            xaxis: {
            categories: ['IOS', 'Android'],
        }
        };
            var chart = new ApexCharts(document.querySelector("#android-ios-chart"), options);
            chart.render();
    </script>

    <!-- gender-chart -->
    <script>
        var options = {
            series: [{{$totalman}},{{$totalwomen}} ],
            chart: {
                width: 340,
                type: 'pie',
            },
            labels: ['MEN', 'WOMEN'],
        };
        var chart = new ApexCharts(document.querySelector("#gender-chart"), options);
        chart.render();
    </script>
    <!-- Month-statistics-chart -->
    <script>
        var options = {
            series: [{
                name: 'Order',
                data: [{{$finishOrders}}, {{$cancelOrders}}, {{$newOrders}}]
            }],
            chart: {
                type: 'bar',
                height: 400
            },
            plotOptions: {
                bar: {
                    borderRadius: 400,
                    horizontal: false,
                }
            },
            fill: {
                colors: ['#400034']
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['Complete', 'Cancel', 'New'],
            }
        };
        var chart = new ApexCharts(document.querySelector("#Month-statistics-chart"), options);
        chart.render();
    </script>
    <!-- top-orders-chart -->
    <script>
        var options = {
            series: [{
                name: 'Order',
                data: [@foreach($orders as $order) {{$order->total}}, @endforeach]
            }],
            chart: {
                type: 'bar',
                height: 200
            },
            plotOptions: {
                bar: {
                    borderRadius: 400,
                    horizontal: true,
                }
            },
            fill: {
                colors: ['#400034']
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: [@foreach($orders as $order) "{{$order->service_basic->ar_title}}", @endforeach],
            }
        };
        var chart = new ApexCharts(document.querySelector("#top-orders-chart"), options);
        chart.render();
    </script>
    <!-- top-orders-chart -->
    <script>
        var options = {
            series: [{
                name: 'Order',
                data: [500, 430, 348]
            }],
            chart: {
                type: 'bar',
                height: 200
            },
            plotOptions: {
                bar: {
                    borderRadius: 400,
                    horizontal: true,
                }
            },
            fill: {
                colors: ['#400034']
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['Soror', 'gaseel', 'carspa'],
            }
        };
        var chart = new ApexCharts(document.querySelector("#top-apps-chart"), options);
        chart.render();
    </script>
    <!-- orders-chart -->
    <script>
        var options = {
                series: [{
                    name: 'Orders',
                    data: [440, 150, 270, 560, 610, 480, 630, 310, 180, 630, 60, 0]
                }],
                chart: {
                    type: 'bar',
                    height: 200
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '18%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                },
                fill: {
                    colors: ['#400034'],
                    opacity: 1
                },
            },
            chart = new ApexCharts(document.querySelector("#orders-chart"), options);
        chart.render();
    </script>
<script>



    var options = {
        series: [{
            name: 'Order',
            data: [{{$finalios}}, {{$finalandroid}},{{$finalweb}}]
        }],
        chart: {
            type: 'bar',
            height: 200
        },
        plotOptions: {
            bar: {
                borderRadius: 400,
                horizontal: true,
            }
        },
        fill: {
            colors: ['#400034']
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['IOS', 'Android','web'],
        }
    };
    var chart = new ApexCharts(document.querySelector("#android-ios-chart"), options);
    chart.render();



</script>

@endsection
@section('content')
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
                <button onclick="convert()" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export PDF
                </button>
            </div>
        </div>



        <!-- end page title -->
        <div class="row">
            @foreach($orders as $order)
                <div class="col-xl-3 col-sm-6">
                    <div class="card four-coulum">
                        <div class="card-body">
                            <div class=" content-of-four d-flex text-white">
                                <div class="order-number">
                                    <p class="num mb-1"> {{$order->total}} </p>
                                    <p class="mb-0 para"> عدد الطلبات </p>
                                </div>
                                <div class="value-number">
                                    <p class="num mb-1"> {{$order->price}}$ </p>
                                    <p class="mb-0 para">اجمالي القيمة </p>
                                </div>
                                <div class="img-div">
                                    <img src="{{url('assets/admin')}}/images/icons/2.png" alt="">
                                    <h6 class="text-white"> {{($order->service_basic->ar_title)??'--'}} </h6>
                                </div>
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
            @endforeach
            <!-- end col -->

            <!-- end col -->

            <!-- end col -->

            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 text-center">
                                <thead>
                                <tr>
                                    <th scope="col"> إجمالي الطلبات </th>
                                    <th scope="col"> إجمالي المبيعات </th>
                                    <th scope="col"> إجمالي الكاش </th>
                                    <th scope="col"> إجمالي الفيزا </th>
                                    <th scope="col"> إجمالي الشبكة </th>
                                    <th scope="col"> إجمالي رصيد المحفظة </th>

                                    <th scope="col"> عدد الفنيين </th>
                                    <th scope="col"> عدد السيارات </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$totalorders[0]->total}}
                                    </td>
                                    <td>{{$totalorders[0]->price}}</td>
                                    <td>{{$cash}}</td>
                                    <td>{{$vesa}}</td>
                                    <td>{{$shabka}}</td>
                                    <td>{{$mahfeza}}</td>

                                    <td>
                                        {{$users}}
                                    </td>
                                    <td>
                                        {{$totalorders[0]->carsnumber}}
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>


        <!-- charts -->
        <div class="row justify-content-end">
            <!-- ORDER BY ANDROID VS IOS -->
            <div class="col-xl-5 p-2">
                <div class="card m-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-end">ORDER BY ANDROID VS IOS </h5>
                            </div>
                        </div>
                        <div>
                            <div id="android-ios-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- Top Locations Clients -->
            @php

            $count=\App\Models\User::count();

            @endphp
            <div class="col-lg-3 p-2">
                <div class="card m-0 h-100">
                    <div class="card-body">
                        <h4 class="card-title text-end"> Top Locations Clients </h4>
                        <div class="pe-3">
                        @foreach($groups as $group)
                            <a href="#" class="text-body d-block">
                                <div class="d-flex p-3">
                                    <div class="flex-grow-1 overflow-hidden d-flex justify-content-between">
                                        <h5 class="font-size-14 mb-1"> {{$group->name}} </h5>
                                        <p class="text-truncate mb-0">
                                           {{count($group->users)/$count*100}}%
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- GENDER CLIENTS -->
            <div class="col-xl-4 p-2">
                <div class="card m-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-end">GENDER CLIENTS </h5>
                            </div>
                        </div>
                        <div>
                            <div id="gender-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- Month order statistics -->
            <div class="col-xl-6 p-2">
                <div class="card  h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-center">Month order statistics </h5>
                            </div>
                        </div>
                        <div>
                            <div id="Month-statistics-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-6 p-2 h-100">
                <!-- Top Orders -->
                <div class="card h-100  ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-end">Top Orders </h5>
                            </div>
                        </div>
                        <div>
                            <div id="top-orders-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!-- TOP APPs Revenue  -->
                <div class="card h-100 mb-0 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-end">TOP APPs Revenue  </h5>
                            </div>
                        </div>
                        <div>
                            <div id="top-apps-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>



            </div>
            <!-- Month order statistics -->
            <div class="col-xl-6 p-2">
                <!-- Months Order Statistics -->
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="card-title text-end">Months Order Statistics </h5>
                            </div>
                        </div>
                        <div>
                            <div id="orders-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection

