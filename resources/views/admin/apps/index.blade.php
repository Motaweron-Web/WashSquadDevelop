@extends('admin.layouts.inc.app')

@section('style')
    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

        <div class="page-content apps">
            <div class="container-fluid">
                <!-- date -->
                <div class="d-flex flex-wrap justify-content-lg-between align-items-center mb-3">
                    <div class="p-2">
                        <a href="{{route('admin.Apps.creat')}}" class="stoped">
                            <i class="fas fa-plus me-2"></i>
                            إضافة تطبيق جديد
                        </a>
                    </div>
                <div class="d-flex">
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
                        <a href="{{route('admin.Apps.excel')}}" class="form-control" id="downloadExcel" type="button" > <i class="fas fa-download me-2"></i> Export Excel </a>

                        {{--            </div>--}}
                        {{--            <div class=" p-1 p-xl-2 col-md-6">--}}
                        {{--                <button id="downloadExcel" class="form-control" type="button">EXport To EXcel</button>--}}
                        {{--            </div>--}}

                    </div>
                </div>

                </div>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0 text-center rounded" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table ">
                            <thead style="background: linear-gradient(0deg, #a85f51, #430036); color: #fff;">
                            <tr>
                                <th> الإسم </th>
                                <th> الشعار </th>
                                <th> تاريخ الإنضمام </th>
                                <th> عدد الطلبات </th>
                                <th> المقبولة </th>
                                <th> الملغية </th>
                                <th> إجمالي المبيعات </th>
                                <th> نسبة العمولة </th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody>
@isset($Apps)
    @foreach($Apps as $App)
                            <tr>
                                <td>{{$App->name}} </td>
                                <td> <img src="{{asset(''.$App->logo)}}" alt="" srcset=""> </td>
                                <td> {{$App->created_at}} </td>
                                <td> {{\App\Models\Order::where('user_id',$App->id)->count()}} </td>
                                <td> {{\App\Models\Order::where('user_id',$App->id)->where('status',13)->count()}} </td>
                                <td> {{\App\Models\Order::where('user_id',$App->id)->where('status',5)->count()}}  </td>
                                <td> {{\App\Models\Order::where('user_id',$App->id)->sum('total_price')}}</td>
                                <td> {{$App->ratio}} </td>
                                <td>
                                    <a href="{{route('admin.Apps.edit',$App->id)}}" class="more-details me-3"> تعديل </a>
                                    <a href="{{route('admin.appStatus')}}"> <img src="{{asset('assets/admin/images/icons/assessment.svg')}}" style="width: 30px; height: 30px;" alt=""> </a>
                                </td>
                            </tr>
    @endforeach
@endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        @endsection

        @section('js')

                <script>
                    $('#changeFilter').on('change',function(){
                        var val = $(this).val();
                        var myUrl = "{{route('admin.Apps')}}?month={{date('Y-m')}}&type=filter&filter="+val
                        window.location = myUrl
                    });
                    $('#choseMonth').on('keyup keydown change', function(){
                        var val = $(this).val();
                        var myUrl = "{{route('admin.Apps')}}?month="+val+"&type=month";
                        window.location = myUrl
                    });
                </script>
                <script>
                    document.getElementById('downloadExcel').addEventListener('click', function () {
                        var table2excel = new Table2Excel();
                        table2excel.export(document.querySelectorAll("#datatable-buttons"));
                    });
                </script>

            <script src="{{asset('assets/admin/libs/dropzone/min/dropzone.min.js')}}"></script>

        @endsection

