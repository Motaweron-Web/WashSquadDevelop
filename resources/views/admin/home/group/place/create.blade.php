@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('groups.index')}}"> المناطق و الاحياء </a> </li>
            <li class="breadcrumb-item"> <a href="{{route('getregiondetails',$group->id)}}"> {{$group->name}} </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> </a> اضاقة حي  </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addplacetoregion',$group->id)}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label"> اسم الحي باللغة العربية </label>
                <input class="form-control" name="ar_name" value="" type="text" >
            </div>
            <div class="mb-3">
                <label class="form-label"> اسم الحي باللغة الانجليزية </label>
                <input class="form-control" name="en_name" value="" type="text" >
            </div>

            <div class="d-flex align-items-center my-3 ">
                <label class="form-label"> الحد الأدني للطلب </label>
                <div class="number ms-4">
                    <span class="minus">-</span>
                    <input class="count" name="minimum_order"  type="number" value="0" />
                    <span class="plus">+</span>
                </div>
            </div>
            <div class="d-flex align-items-center my-3 ">
                <label class="form-label"> تكلفة اضافية </label>
                <div class="number ms-4">
                    <span class="minus">-</span>
                    <input class="count" name="maximum_order"  type="number" value="0" />
                    <span class="plus">+</span>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 p-2">
                    <label class="form-label"> طرق الدفع </label>
                    @foreach($payments as $payment)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="payments[]"  value="{{$payment->id}}" id="{{$payment->id}}">
                            <label class="form-check-label" for="{{$payment->id}}">
                                {{$payment->type}}
                            </label>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-12 p-2">
                    <label class="form-label"> الباقات الرئيسية </label>
                    @foreach($services as $service)
                        <div class="form-check mb-2">
                            <input class="form-check-input" name="services[]"  type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                            <label class="form-check-label" for="{{$service->id}}">
                                {{$service->ar_title}}
                            </label>
                        </div>
                    @endforeach

                </div>



            </div>
            <div class="d-flex align-content-center justify-content-between py-2">
                <div class="d-flex align-items-center ">
                    <label class="form-label m-0"> حالة الحي </label>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" id="wash" type="checkbox" name="status" role="switch" checked >
                    </div>
                </div>

                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>

@endsection

@section('style')



@endsection

@section('js')

<script>

    @if($errors->any())
    toastr.error('يرحي التاكد من البيانت المدخلة');
    @endif
</script>


@endsection
