@extends('admin.layouts.inc.app')
@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> طرق الدفع
                </a>
            </li>
        </ol>
        <a href="{{route('cretepayment')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- discounts -->
    <section class=" discounts drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> النوع </th>
                    <th> تكلفة اضافية </th>
                    <th> التوفر </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                <tr id="{{$payment->id}}" class="serv-border">
                    <td> {{$payment->type}} </td>
                    <td> {{$payment->extracost}} </td>
                    <td> {{$payment->visability}} </td>
                    <td>
                        <div class="actionsIcons">
                            <div paymentid="{{$payment->id}}" class="form-check form-switch ms-3 changepaymentstatus">
                                <input class="form-check-input" id="wash"  @if($payment->display==1)  checked @endif type="checkbox" role="switch"
                                       >
                            </div>
                            <a href="{{route('editpayment',$payment->id)}}" class="edit"> <i
                                    class="fas fa-edit"></i> </a>
                            <a href="#!" paymentid="{{$payment->id}}" class="delete deletepayment"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>








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
        $(document).on("click",".deletepayment", function (e) {
            e.preventDefault();
            var id= $(this).attr('paymentid');

            $.ajax({
                type:'GET',
                url:"{{route('deletepayment')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>


    <script>
        $(document).on("click",".changepaymentstatus", function (e) {
            var id= $(this).attr('paymentid');
            $.ajax({
                type:'GET',
                url:"{{route('changepaymentstatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {


                    }
                    else if(res['status']==false)
                        location.reload();

                    else
                    {
                        location.reload();
                    }


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>



@endsection

