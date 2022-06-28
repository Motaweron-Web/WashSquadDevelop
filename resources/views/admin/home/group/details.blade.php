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
                        @foreach($group->days as $da)
                <select name="days[]" class="form-select">
                    @foreach($days as $day)
                    <option  value="{{$day->id}}" @if($day->id==$da->id)  selected  @endif > {{$day->name}} </option>
                    @endforeach

                </select>
                        @endforeach

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
                @foreach($group->periods as $per)
                <select name="periods[]" class="form-select">
                    @foreach($periods as $period)
                    <option  value="{{$period->id}}" @if($per->id==$period->id) selected  @endif> {{$period->period_title}} {{$period->ar_period_type}} </option>
                    @endforeach
                </select>
                @endforeach
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
                        <td > <span id="stat-{{$place->id}}" placeid="{{$place->id}}" @if( $place->status==1) class="active changestatus" @else class="closed changestatus" @endif > @if( $place->status==1)  مفعل @else  مغلق  @endif </span> </td>
                        <td>
                            <div class="actionsIcons">
                                <a href="{{route('editplace',$place->id)}}"  class="edit "> <i
                                        class="fas fa-edit"></i> </a>
                                <a href="" placeid="{{$place->id}}" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal " id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                        <button type="button" class="close toggle-model" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close toggle-model btn-primary" data-dismiss="modal" aria-label="Close">
                            <span >اغلاق</span>
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Regions -->






@endsection


@section('style')



@endsection

@section('js')


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
//location.reload();

                        if(res['st']==0){
                            $(`#stat-${id}`).toggleClass("active");
                            $(`#stat-${id}`).toggleClass("closed");
                            $(`#stat-${id}`).text("مغلق");
                        }
                        else{
                            $(`#stat-${id}`).toggleClass("active");
                            $(`#stat-${id}`).toggleClass("closed");
                            $(`#stat-${id}`).text("مفعل");

                        }
                        toastr.success("تم تحديث الحالة بنجاح")
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





        $(document).on("click",".delete-data", function (e) {
            e.preventDefault();
            $(function () {
                $('#delete_modal').modal('show');
            });
            var id= $(this).attr('placeid');
            $('#delete_id').val(id);
        });



        $(document).on("click",".toggle-model", function (e) {
            e.preventDefault();
            $(function () {
                $('#delete_modal').modal('toggle');
            });
        });


        $(document).on("click","#delete_btn", function (e) {
            e.preventDefault();
            var id=$('#delete_id').val();

            $.ajax({
                type:'GET',
                url:"{{route('deleteplace')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        toastr.success('تمت عملية الحذف بنجاح')
                        $(`#${id}`).remove();

                        $(function () {
                            $('#delete_modal').modal('toggle');
                        });

                    }
                    else if(res['status']==false)
                        location.reload();

                    else
                        location.reload();

                },
                error: function(data){
                    location.reload();
                }
            });

        });



        @if(session()->has('message'))

        toastr.success('تمت العملية بنجاح');
        @endif





        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif


    </script>














@endsection


