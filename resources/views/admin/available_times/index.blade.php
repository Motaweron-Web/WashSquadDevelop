@extends('admin.layouts.inc.app')
@section('class')
    orders-table operation
@endsection
@section('css')
    @include('admin.layouts.loaders.assets.formLoader')
    <link href="{{url('assets/admin')}}/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
    <link href="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css" />

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
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mod-content">
                        <form action="">
                            <div action="#" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="">
                                        <i class="display-6 fas mo-icon fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> إسم العميل
                                        </label>
                                        <input class="form-control" type="text" id="default-input"
                                               placeholder="بكري">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input">رقم الجوال</label>
                                        <input class="form-control" type="number" id="default-input"
                                               placeholder="213243">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> الحي </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">الحي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> تاريخ الطلب
                                        </label>
                                        <input class="form-control" type="date" id="default-input"
                                               placeholder="Default input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> وقت الطلب
                                        </label>
                                        <input class="form-control" type="time" id="default-input"
                                               placeholder="43432">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> وسيلة الدفع
                                        </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">وسيلة الدفع</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> ماركة السيارة
                                        </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">دايو</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> الفئة </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">الفئة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> نوع الخدمة
                                        </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">غسيل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> عدد السيارات
                                        </label>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="count" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input"> المزود
                                        </label>
                                        <select class="form-select mo-form-select" name="" id="">
                                            <option value="">غسيل</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="w-100 d-flex justify-content-between">
                        <div class="">
                            <button type="button" class="btn stoped  mx-2" data-bs-dismiss="modal">
                                إلغاء </button>
                            <button type="button" class="btn stoped "> أضف </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- date -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <button class="stoped" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                <i class="fas fa-plus me-2"></i>
                إضافة طلب
            </button>
        </div>
        <div class="d-flex flex-wrap justify-content-end align-items-center mb-3">
            <div class=" p-1 p-xl-2">
                <input type="month" class="form-control" id="choseMonth" value="{{date('Y-m',strtotime($year.'-'.$month))}}">
            </div>
        </div>
    </div>

    <div class="container">
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
                            include(resource_path('views/admin/available_times/parts/toDay.php'));
                        else
                            include(resource_path('views/admin/available_times/parts/day.php'));

                        $i++;
                    }elseif($j == $start_day){
                        if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                            include(resource_path('views/admin/available_times/parts/toDay.php'));
                        else
                            include(resource_path('views/admin/available_times/parts/day.php'));

                        $flag = 1;
                        $i++;
                        continue;
                    }
                    else {
                        include(resource_path('views/admin/available_times/parts/prevMonth.php'));
                    }

                }
            }
            ?>
        </div>
        <div id="loadData">

        </div>
    </div>
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
    @include('admin.available_times.assets.js')
    {{--    <!-- Required datatable js -->--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>--}}
    {{--    <!-- Buttons examples -->--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/jszip/jszip.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/pdfmake/build/pdfmake.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/pdfmake/build/vfs_fonts.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>--}}
    {{--    <!-- Responsive examples -->--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>--}}
    {{--    <script src="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>--}}
    {{--    <!-- Datatable init js -->--}}
    {{--    <script src="{{url('assets/admin')}}/js/pages/datatables.init.js"></script>--}}
@endsection
