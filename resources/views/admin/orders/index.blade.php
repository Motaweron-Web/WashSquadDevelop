@extends('admin.layouts.inc.app')
@section('class')
    orders-table operation
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

    <div class="modal fade" id="createOrUpdateModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body" id="createOrUpdateContent">
                </div>
                <div class="modal-footer ">
                    <div class="w-100 d-flex justify-content-between">
                        <div class="">
                            <button type="button" class="btn stoped  mx-2" data-bs-dismiss="modal">
                                إلغاء </button>
                            <button type="submit" form="Form" id="submitBtn" class="btn stoped "> أضف </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body" id="showContent">
                </div>
                <div class="modal-footer ">
                    <div class="w-100 d-flex justify-content-between">
                        <div class="">
                            <button type="button" class="btn stoped  mx-2" data-bs-dismiss="modal">
                                إلغاء </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- date -->
    <div class="d-flex flex-wrap justify-content-end mb-3">
        <div class=" p-1 p-xl-2">
            <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

        </div>

                <div class=" p-1 p-xl-2">
                    <button class="stoped create-btn" data-url="{{route('orders.create')}}">
                        <i class="fas fa-plus me-2"></i>
                        إضافة طلب </button>
                </div>

        <div class=" p-1 p-xl-2">
            <button class="create-btn daily-order d stoped" data-url="{{route('orders.dailyOrder')}}">
                <i class="fas fa-plus me-2"></i>
                  توزيع الطلبات اليومية </button>
        </div>
    </div>
    <div class="container">
        <div class="   hints d-flex align-items-center justify-content-end">
            <p class="px-2 py-1"> polishing <i class="polish fas fa-circle ps-1"></i> </p>
            <p class="px-2 py-1"> wash <i class="wash fas fa-circle ps-1"></i> </p>
            <p class="px-2 py-1"> Sterilization <i class="sterili fas fa-circle ps-1"></i> </p>
            <p class="px-2 py-1"> Monthly subscription <i class="month fas fa-circle ps-1"></i> </p>
            <p class="px-2 py-1"> Gift <i class="gift fas fa-circle ps-1"></i> </p>
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
                            include(resource_path('views/admin/orders/parts/toDay.php'));
                        else
                            include(resource_path('views/admin/orders/parts/day.php'));

                        $i++;
                    }elseif($j == $start_day){
                        if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                            include(resource_path('views/admin/orders/parts/toDay.php'));
                        else
                            include(resource_path('views/admin/orders/parts/day.php'));

                        $flag = 1;
                        $i++;
                        continue;
                    }
                    else {
                        include(resource_path('views/admin/orders/parts/prevMonth.php'));
                    }

                }
            }
            ?>



        </div>
    </div>
    <div class="table-rep-plugin">
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table  nowrap">
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
                    <th> السائق </th>
                    <th> الموقع </th>
                    <th> فاتورة </th>
                    <th> إعدادات </th>
                </tr>
                </thead>
                <tbody id="bodyToLoad">

                </tbody>
            </table>
        </div>
    </div>
    <div style='clear:both'></div>
    <!-- Add New Event MODAL -->
    <div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3 px-4">
                    <h5 class="modal-title" id="modal-title"> إضافة </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" name="event-form" id="form-event" novalidate>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label"> ملاحظة </label>
                                    <input class="form-control" placeholder="" type="text" name="title"
                                           id="event-title" required value="">
                                    <div class="invalid-feedback">من فضلك أكتب المطلوب
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <select class="form-select" name="category" id="event-category">
                                        <optionn selected> --Select-- </optionn>
                                        <option>gift</option>
                                        <option>Monthly subscription </option>
                                        <option>Sterilization </option>
                                        <option>wash </option>
                                        <option>polishing </option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid event
                                        category</div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                        <div class="row mt-2">
                            <div class="col-6">
                                <!-- <button type="button" class="btn btn-danger"
                                    id="btn-delete-event">Delete</button> -->
                            </div>
                            <!-- end col-->
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-light me-1"
                                        data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                    </form>
                </div>
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal dialog-->
    </div>
    <!-- end modal-->
@endsection
@section('js')
    @include('admin.orders.assets.js')
@endsection
