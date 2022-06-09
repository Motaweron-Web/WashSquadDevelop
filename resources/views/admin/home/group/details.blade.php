@extends('admin.layouts.inc.app')

@section('content')


    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('groups.index')}}"> المناطق و الاحياء </a> </li>
            <li class="breadcrumb-item active"> <a href=""> {{$group->name}} </a> </li>
        </ol>
        <div>
            <a href="{{route('createplcetoregion',$group->id)}}" class="btn mainBtn"> اضافة حي <i
                    class="fas fa-plus-circle ms-2"></i> </a>

            <button class="btn btn-dark" onclick="history.back()"> عودة </button>
        </div>
    </div>
    <!-- end breadcrumb -->

    <!-- Regions -->
    <section class="regions ">
       <form action="{{route('createorupdateregionperiodandday',$group->id)}}"method="post">
           @csrf
        <!-- times -->
        <div class="times">
            <div class="row">
                <div class="col-md-10">
            <h6> اختر الايام </h6>
            <!-- days -->

                    <div id="days" count=1 class="days">
                <select name="days[]" class="form-select">
                    @foreach($days as $day)
                    <option  value="{{$day->id}}" > {{$day->name}} </option>
                    @endforeach

                </select>


                <div  id="addDays"class="add">
                    <i class="fas fa-plus-circle"></i>
                </div>

            </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn mainBtn"> اضافة الفترات  <i
                            class="fas fa-plus-circle ms-2"></i> </button>
                </div>
            </div>
                <!-- end days -->

            <h6> اختر الفترات </h6>
            <!-- intervals -->
            <div id="intervals" count=1 class="intervals">
                <select name="periods[]" class="form-select">
                    @foreach($periods as $period)
                    <option  value="{{$period->id}}"> {{$period->period_title}} {{$period->ar_period_type}} </option>
                    @endforeach
                </select>

                <div id="addIntervals" class="add">
                    <i class="fas fa-plus-circle"></i>
                </div>

            </div>
            <!-- end intervals -->
                </div>

        <!-- end times -->
       </form>
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> اسم الحي </th>
                    <th> المجموعة </th>
                    <th> الحد الادنى </th>
                    <th> تكلفة اضافية </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($places as $place)
                    <tr id="{{$place->id}}" class="serv-border">
                        <td> {{$place->ar_name}} </td>
                        <td> {{$place->group->name}} </td>
                        <td> {{$place->minimum_order}}SR </td>
                        <td> {{$place->maximum_order}} SR </td>
                        <td> @foreach($place->payments as $payment) {{$payment->type}}- @endforeach </td>
                        <td> <span placeid="{{$place->id}}" @if( $place->status==1) class="active changestatus" @else class="closed changestatus" @endif > @if( $place->status==1)  مفعل @else  مغلق  @endif </span> </td>
                        <td>
                            <div class="actionsIcons">
                                <a href="{{route('editplace',$place->id)}}"  class="edit "> <i
                                        class="fas fa-edit"></i> </a>
                                <a href="" placeid="{{$place->id}}" class="delete deletesub"> <i class="fas fa-trash-alt"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </section>
    <!-- End Regions -->






@endsection


@section('style')

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        // add new select Days
        $(document).ready(function () {

            $('#addDays').on('click', function () {
                var DaysSelect = ` <select name="days[]" class="form-select">
                                               @foreach($days as $index=> $day)
                             <option  value="{{$day->id}}"  > {{$day->name}} </option>
                                                 @endforeach
                </select>` ;
      var length={{count($days)}};
      var count= $("#days").attr('count');
                  if(count<length) {
                      $("#days").prepend(DaysSelect);
                   var newcount=eval(count)+1;
                      $("#days").attr('count',newcount)
                  }

            });
        });
        // add new select Intervals
        $(document).ready(function () {
            $('#addIntervals').on('click', function () {
                var intervalSelect = ` <select name="periods[]" class="form-select">
                                            @foreach($periods as $period)
                                <option  value="{{$period->id}}"> {{$period->period_title}} {{$period->ar_period_type}} </option>
                                             @endforeach
                                            </select> ` ;


                var length={{count($periods)}};
                var count= $("#intervals").attr('count');
                if(count<length) {
                    $("#intervals").prepend(intervalSelect);
                    var newcount=eval(count)+1;
                    $("#intervals").attr('count',newcount)
                }





            });
        });

    </script>

    <script>

        $(document).on("click",".deletesub", function (e) {
            e.preventDefault();
            var id= $(this).attr('placeid');
            $.ajax({
                type:'GET',
                url:"{{route('deleteplace')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();
                    }
                    else if(res['status']==false)
                        alert('false');

                    else
                        alert('fff');

                },
                error: function(data){

                }
            });

        });



        $(document).on("click",".changestatus", function (e) {
            e.preventDefault();
            var id= $(this).attr('placeid');
            $.ajax({
                type:'GET',
                url:"{{route('placechangestatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        location.reload();

                    }
                    else if(res['status']==false)
                        alert('false');

                    else
                        alert('fff');

                },
                error: function(data){

                }
            });

        });
    </script>














@endsection


