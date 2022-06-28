@extends('admin.layouts.inc.app')

@section('content')


    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('admin.purchase.index')}}"> المشتريات
                </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('admin.purchase.update',$purchase->id)}}" method="post" >
            @csrf
            <div class="row">

                <div class="col-md-6 p-2">
                    <label class="form-label"> التاريخ </label>
                    <input class="form-control" value="{{$purchase->date}}" name="date" type="date">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> الاسم </label>
                    <input class="form-control" value="{{$purchase->name}}" name="name" type="text">
                </div>

                <div class="col-md-6 p-2">
                    <label class="form-label"> التصنيف </label>
                    <input class="form-control" value="{{$purchase->category}}" name="category" type="text">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> القيمة </label>
                    <input class="form-control" value="{{$purchase->value}}" name="value" type="text">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> العدد </label>
                    <input class="form-control" value="{{$purchase->count}}" name="count" type="number">
                </div>

                <div class="col-md-6 p-2">
                    <label class="form-label"> طرق الدفع </label>
                    <div class="d-flex flex-column">
                        <div class="form-check px-4">
                            <input class="form-check-input"  @if($purchase->payment_method=='cash')  checked  @endif type="radio" name="payment_method" id="pay1"
                                   value="cash">
                            <label class="form-check-label" for="pay1">
                                كاش
                            </label>
                        </div>
                        <div class="form-check px-4">
                            <input class="form-check-input" @if($purchase->payment_method=='bankTransfer')  checked  @endif type="radio" name="payment_method" id="pay2"
                                   value="bankTransfer">
                            <label class="form-check-label" for="pay2">
                                تحويل بنكي
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn "> حفظ و إغلاق </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->






@endsection

@section('js')

    <script>

        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif

    </script>



@endsection
