@extends('admin.layouts.inc.app')
@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getpaymentmethod')}}"> طرق الدفع </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addpayment')}}" method="post" class="p-3">
            @csrf
            <div class="row">
                <div class="col-md-7 p-2">
                    <div class="mb-3">
                        <label class="form-label"> النوع </label>
                        <input class="form-control" name="type" type="text">
                    </div>
                </div>
                <div class="col-md-7 p-2">
                    <div class="mb-3">
                        <label class="form-label"> التكلفة الاضافية </label>
                        <input class="form-control"  name="extracost" type="text">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <label class="form-label"> التوفر و الظهور </label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="visability[]" type="checkbox" value="حجوزات التطبيق" id="service1">
                        <label class="form-check-label" for="service1">
                            حجوزات التطبيق
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="visability[]" type="checkbox" value="حجوزات المسوقين" id="service2">
                        <label class="form-check-label" for="service2">
                            حجوزات المسوقين
                        </label>
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


    @endsection

    @section('js')
        <script>

            @if($errors->any())
            toastr.error('يرجي التاكد من البيانت المدخلة');
            @endif

        </script>

    @endsection

