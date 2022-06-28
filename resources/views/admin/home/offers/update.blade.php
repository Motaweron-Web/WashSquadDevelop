@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getoffers')}}"> العروض
                </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('updateoffer',$offer->id)}}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-md-6 p-2">
                    <label class="form-label"> صورة الخدمة عربي </label>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="file"  name="ar_image" id="input-file-now-custom-1" class="dropify"
                                   data-default-file="{{asset(''.$offer->ar_image)}}" >
                        </div>
                    </div>
                </div>

                <div class="col-md-6 p-2">
                    <label class="form-label"> صورة الخدمة انجليزي </label>
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="file"  name="en_image" id="input-file-now-custom-2" class="dropify"
                                   data-default-file="{{asset(''.$offer->en_image)}}" >
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-8 p-2">
                    <div class="mb-3">
                        <label class="form-label"> الباقة </label>
                        <select name="service_id" class="form-select">
                            @foreach($services as $service)
                                <option @if($offer->service->id==$service->id) selected @endif value="{{$service->id}}"> {{$service->ar_title}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 p-2">
                    <div class="mb-3">
                        <label class="form-label"> تاريخ الانتهاء </label>
                        <input name="expiredate" value="{{date('Y:m:d',$offer->expiredate)}}" class="form-control" type="date">
                    </div>
                </div>

            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->








@endsection

@section('style')

    @section('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.min.css')}}">


    @endsection

@endsection

@section('js')

    <script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>



    <script>
        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif
        $('.dropify').dropify();
        $(function () {
            $(document).on("click", "#saveImage", function (event) {
                let myForm = document.getElementById('saveForm');
                let formData = new FormData(myForm);
                uploadImage(formData);
                console.log(formData);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>



    <script>
        $(document).on("click",".deletesub", function (e) {
            e.preventDefault();
            var id= $(this).attr('serviceid');
            $.ajax({
                type:'GET',
                url:"{{route('deletesubservice')}}",
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
                    alert('error');
                }
            });

        });
    </script>
@endsection

