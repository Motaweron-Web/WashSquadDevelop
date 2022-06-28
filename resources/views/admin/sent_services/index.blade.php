@extends('admin.layouts.inc.app')
@section('class')
    monthly_subscription-table operation monthly-subscription
@endsection
@section('style')

    <link rel="stylesheet" href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}">

@endsection


@section('content')

    <div class="row mb-3">


        <div class="col-12 row mb-3">
            <div class="add-button col-sm-6">
                <button class="stoped" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                    طلب جديد
                </button>
            </div>

            <div class="d-flex flex-wrap justify-content-end mb-3">
                <div class="row">
                    <div class=" p-1 p-xl-2 col-md-6">
                        <button id="downloadExcel" class="form-control" type="button">EXport To EXcel</button>
                    </div>

                    <div class=" p-1 p-xl-2 col-md-6">
                        <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

                    </div>


                </div>
            </div>


            <div class="col-md-12 ">


                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                        <table id="datatable-buttons" class="table dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th> رقم الطلب</th>
                                <th> تاريخ الطلب</th>
                                <th> نوع الخدمة</th>
                                <th> العدد</th>
                                <th>خدمة اضافة</th>
                                <th> اسم المرسل</th>
                                <th> رقم الجوال</th>
                                <th> اسم المرسل اليه</th>
                                <th> رقم الجوال</th>
                                <th> الماركة</th>
                                <th> الإجمالى</th>
                                <th> فاتورة</th>
                                <th>الحالة</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @php
                                    $firstSubServiceTitle = '';
                                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                                        if($subServiceOrder->count()){
                                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                                        }
                                @endphp
                                <tr class="   serv-border  " id="{{$order->id}}">
                                    <td> {{$order->id}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->service->ar_title??''}}</td>
                                    <td>{{$order->number_of_cars}}</td>
                                    <td>{{$firstSubServiceTitle}}</td>
                                    <td> {{$order->from_user->full_name??''}}</td>
                                    <td>{{$order->from_user->phone??''}}</td>
                                    <td>{{$order->user->full_name??''}}</td>
                                    <td>{{$order->user->phone??''}}</td>
                                    <td> {{$order->type->ar_title??''}}</td>
                                    <td> {{$order->total_price}}SR</td>
                                    <td><a href="javascript:genScreenshot({{$order->id}})"> <i
                                                class="fas fa-file-pdf"></i> </a></td>

                                    <td><span
                                            class="badge bg-{{$order -> status == 1?'success':'danger'}}">{{$order -> status == 1?'مفعل':'غير مفعل'}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="mod-content">

                                @include('admin.alerts.success')
                                @include('admin.alerts.errors')

                                <form action="{{route('admin.SentServices.store')}}" method="post"
                                      enctype="multipart/form-data">

                                    @csrf
                                    <div action="/upload" class="dropzone" id="demo-upload">
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
                                            <div class="mb-3 ">
                                                <label class="form-label" for="default-input"> إسم العميل
                                                </label>
                                                <input class="form-control " name="full_name" type="text"
                                                       id="default-input"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input">رقم الجوال</label>
                                                <input class="form-control numbersOnly" name="phone" type="text"
                                                       id="default-input"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> الحي </label>
                                                <select class="form-select mo-form-select" name="place_id" id="">
                                                    <option value="" selected disabled>الحي</option>
                                                    @foreach($places as $place)
                                                        <option value="{{$place->id}}">{{$place->title_ar}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> تاريخ الطلب
                                                </label>
                                                <input class="form-control" name="order_date" type="date"
                                                       id="default-input"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> وقت الطلب
                                                </label>
                                                <input class="form-control" name="order_time" type="time"
                                                       id="default-input"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> وسيلة الدفع
                                                </label>
                                                <select class="form-select mo-form-select" name="payment_method"
                                                        id="">
                                                    <option value="" selected disabled>وسيلة الدفع</option>
                                                    <option value="2">كاش</option>
                                                    <option value="3">نقطة البيع</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> ماركة السيارة
                                                </label>
                                                <select class="form-select mo-form-select" id="selectCarType"
                                                        name="type_id">
                                                    <option value="" selected disabled>ماركة السيارة</option>
                                                    @foreach($carTypes as $carType)
                                                        <option
                                                            value="{{$carType->id}}">{{$carType->ar_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> الفئة </label>
                                                <select class="form-select mo-form-select" name="sub_type_id"
                                                        id="sub_type_id">
                                                    <option value="" selected disabled>إختر الماركة أولا</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> نوع الخدمة
                                                </label>
                                                <select class="form-select mo-form-select" name="service_id"
                                                        id="service_id">
                                                    @foreach ($services as $service)
                                                        <option
                                                            value="{{$service->id}}">{{$service->ar_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="default-input"> عدد السيارات
                                                </label>
                                                <div class="number">
                                                    <span class="minus minusOrder">-</span>
                                                    <input class="count numbersOnly" name="number_of_cars"
                                                           id="number_of_cars" type="text" value="0"/>
                                                    <span class="plus placeOrder">+</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <div class="w-100 d-flex justify-content-between">
                                                <div class="">
                                                    <button type="submit" class="stoped  mx-2"
                                                            data-bs-dismiss="modal"> إلغاء
                                                    </button>
                                                    <button type="submit" class="btn stoped "> أضف</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{--            <div class="col-md-6">--}}
                                        {{--                <div class="mb-3">--}}
                                        {{--                    <label class="form-label" for="default-input"> المزود--}}
                                        {{--                    </label>--}}
                                        {{--                    <select class="form-select mo-form-select" name="" id="">--}}
                                        {{--                        <option value="">غسيل</option>--}}
                                        {{--                    </select>--}}
                                        {{--                </div>--}}
                                        {{--            </div>--}}
                                    </div>
                                    <input id="checkbox-value" type="hidden" value="0">
                                    <input id="total-value" type="hidden" value="0">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{url('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>


    <script src="{{asset('dist/table2excel.js')}}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{url('assets/admin')}}/libs/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('assets/admin')}}/libs/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- dropzone js -->
    <script src="{{url(asset('assets/libs/dropzone/min/dropzone.min.js'))}}"></script>
    <!-- Required datatable js -->
    <script
        src="{{url('assets/admin')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script
        src="{{url('assets/admin')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script
        src="{{url('assets/admin')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script
        src="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

    <script>
        //  var a = $("#datatable-buttons").DataTable({
        //      // lengthChange: !1,
        //      "order": [[ 5, "Asc" ]],
        //
        //      language: {
        //          "sProcessing":   "تحميل",
        //          "sLengthMenu":   "اظهار _MENU_ سجل",
        //          "sZeroRecords":  "لا يوجد نتائج للبحث",
        //          "sInfo":         "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
        //          "sInfoEmpty":    "معلومات خالية",
        //          "sInfoFiltered": "معلومات منتقاه",
        //          "sInfoPostFix":  "",
        //          "sSearch":       "بحث:",
        //          "sUrl":          "",
        //          "oPaginate": {
        //              "sFirst":    "الاول",
        //              "sPrevious": "السابق",
        //              "sNext":     "التالى",
        //              "sLast":     "الاخير"
        //          },
        //          paginate: {
        //              previous: "<i class='mdi mdi-chevron-right'>",
        //              next: "<i class='mdi mdi-chevron-left'>"
        //          }
        //      },
        //      drawCallback: function (){
        //          $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        //      },
        //
        //      /////////////////////////////////////////////////////////
        //      buttons: [ "excel",  ]
        //      // "pdf"
        // });
        //////////////////////////////////////////////////
        $('#choseMonth').on('keyup keydown change', function () {
            var val = $(this).val()
            window.location.href = "{{route('sent-services.index')}}" + "?month=" + val
        });
    </script>
    <script>
        // Show Governorates
        var types = JSON.parse('<?php echo json_encode($carTypes) ?>');

        $(document).on('change', '#selectCarType', function () {
            var id = $(this).val();
            var type = types.filter(oneObject => oneObject.id == id)
            if (type.length > 0) {
                var subTypes = type[0].sub_types

                $('#sub_type_id').html('<option value="">إختر الفئة</option>')

                $.each(subTypes, function (index) {
                    $('#sub_type_id').append('<option data-size="' + subTypes[index].size + '" value="' + subTypes[index].id + '">' + subTypes[index].ar_title + '</option>')
                })
            }
        })


    </script>










    <script src="{{asset('assets/js/table2excel.js')}}"></script>

    <script>

        document.getElementById('downloadExcel').addEventListener('click', function () {
            var table2excel = new Table2Excel();

            table2excel.export(document.querySelectorAll("#datatable-buttons"));
        });
    </script>



    <script>
        function genScreenshot(id) {
            html2canvas($(`#${id}`), {
                onrendered: function (canvas) {
                    $('#pdf').html("");
                    $('#pdf').append(canvas);

                    if (navigator.userAgent.indexOf("MSIE ") > 0 ||
                        navigator.userAgent.match(/Trident.*rv\:11\./)) {
                        var blob = canvas.msToBlob();

                        window.navigator.msSaveBlob(blob, 'Test file.png');

                    } else {

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
var dropzone = new Dropzone('#demo-upload', {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 3,
    filesizeBase: 1000,
    thumbnail: function (file, dataUrl) {
        if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
                var thumbnailElement = images[i];
                thumbnailElement.alt = file.name;
                thumbnailElement.src = dataUrl;
            }
            setTimeout(function () {
                file.previewElement.classList.add("dz-image-preview");
            }, 1);
        }
    }

        });


        // Now fake the file upload, since GitHub does not handle file uploads
        // and returns a 404

        var minSteps = 6,
            maxSteps = 60,
            timeBetweenSteps = 100,
            bytesPerStep = 100000;

        dropzone.uploadFiles = function (files) {
            var self = this;

            for (var i = 0; i < files.length; i++) {

                var file = files[i];
                totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                for (var step = 0; step < totalSteps; step++) {
                    var duration = timeBetweenSteps * (step + 1);
                    setTimeout(function (file, totalSteps, step) {
                        return function () {
                            file.upload = {
                                progress: 100 * (step + 1) / totalSteps,
                                total: file.size,
                                bytesSent: (step + 1) * file.size / totalSteps
                            };

                            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                            if (file.upload.progress == 100) {
                                file.status = Dropzone.SUCCESS;
                                self.emit("success", file, 'success', null);
                                self.emit("complete", file);
                                self.processQueue();
                                //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
                            }
                        };
                    }(file, totalSteps, step), duration);
                }
            }
            // toastr.success('ss')
        }
    </script>

@endsection
