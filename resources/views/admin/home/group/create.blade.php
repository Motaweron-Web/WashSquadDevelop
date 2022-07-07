@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('groups.index')}}"> المجموعات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> اضافة  </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->

    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addregion')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label"> اسم المجموعة </label>
                <input class="form-control" value="{{old('name')}}" name="name" type="text" >
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
    toastr.error('يرحي التاكد من البيانت المدخلة');
    @endif

</script>



@endsection
