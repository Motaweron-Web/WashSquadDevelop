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
                <tbody id="bodyToLoad">

                </tbody>
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

@endsection
@section('js')
    @include('admin.monthly_subscription.assets.js')
@endsection
