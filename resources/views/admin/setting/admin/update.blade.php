@extends('admin.layouts.inc.app')

@section('content')


    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('admin.setting')}}"> المستخدمين </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> تعديل  </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->

    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('admin.update.admin',$admin->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="mb-4">
                        <label class="form-label"> اسم المستخدم </label>
                        <input class="form-control" name="name" value="{{$admin->name}}" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> كلمة المرور </label>
                        <input class="form-control" name="password" value="" type="password">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">  الايميل </label>
                        <input class="form-control" name="email" value="{{$admin->email}}" type="email">
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <label class="form-label"> صورة  </label>
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="file"  name="image" id="input-file-now-custom-2" class="dropify"
                                   data-default-file="{{asset(''.$admin->image)}}" >
                        </div>
                    </div>

                </div>
            </div>
            <h5 class="form-label mb-4"> صلاحيات الوصول </h5>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> الرئيسية</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" @foreach($admin->permissions as $permission)  @if($permission->id==1)  checked  @endif    @endforeach name="permissions[]" type="checkbox" value="{{\App\Models\Permission::find(1)->id}}" id="main1">
                        <label class="form-check-label" for="main1">
                            {{\App\Models\Permission::find(1)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> المبيعات </label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==2)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(2)->id}}" id="main1">
                        <label class="form-check-label" for="main1">
                            {{\App\Models\Permission::find(2)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> الطلبات</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==3)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(3)->id}}" id="order1">
                        <label class="form-check-label" for="order1">
                            {{\App\Models\Permission::find(3)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==4)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(4)->id}}" id="order2">
                        <label class="form-check-label" for="order2">
                            {{\App\Models\Permission::find(4)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==5)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(5)->id}}" id="order3">
                        <label class="form-check-label" for="order3">
                            {{\App\Models\Permission::find(5)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==6)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(6)->id}}" id="order4">
                        <label class="form-check-label" for="order4">
                            {{\App\Models\Permission::find(6)->name}}
                        </label>
                    </div>
                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> التطبيقات</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" name="permissions[]" type="checkbox" @foreach($admin->permissions as $permission)  @if($permission->id==7)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(7)->id}}" id="app1">
                        <label class="form-check-label" for="app1">
                            {{\App\Models\Permission::find(7)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> العمليات</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" name="permissions[]" type="checkbox"@foreach($admin->permissions as $permission)  @if($permission->id==8)  checked  @endif    @endforeach  value="{{\App\Models\Permission::find(8)->id}}" id="operation1">
                        <label class="form-check-label" for="operation1">
                            {{\App\Models\Permission::find(8)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> السائقين</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" name="permissions[]" type="checkbox" @foreach($admin->permissions as $permission)  @if($permission->id==9)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(9)->id}}" id="driver1">
                        <label class="form-check-label" for="driver1">
                            {{\App\Models\Permission::find(9)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> الشؤون المالية </label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==10)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(10)->id}}" id="reprot1">
                        <label class="form-check-label" for="reprot1">
                            {{\App\Models\Permission::find(10)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==11)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(11)->id}}" id="reprot2">
                        <label class="form-check-label" for="reprot2">
                            {{\App\Models\Permission::find(11)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==12)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(12)->id}}" id="reprot3">
                        <label class="form-check-label" for="reprot3">
                            {{\App\Models\Permission::find(12)->name}}
                        </label>
                    </div>
                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> التقارير المالية </label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==13)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(13)->id}}" id="money1">
                        <label class="form-check-label" for="money1">
                            {{\App\Models\Permission::find(13)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==14)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(14)->id}}" id="money2">
                        <label class="form-check-label" for="money2">
                            {{\App\Models\Permission::find(14)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==15)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(15)->id}}" id="money3">
                        <label class="form-check-label" for="money3">
                            {{\App\Models\Permission::find(15)->name}}
                        </label>
                    </div>
                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> العملاء</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==16)  checked  @endif    @endforeach type="checkbox" value="{{\App\Models\Permission::find(16)->id}}" id="client1">
                        <label class="form-check-label" for="client1">
                            {{\App\Models\Permission::find(16)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> إعدادات التطبيق </label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==17)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(17)->id}}" id="setting1">
                        <label class="form-check-label" for="setting1">
                            {{\App\Models\Permission::find(17)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==18)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(18)->id}}" id="setting2">
                        <label class="form-check-label" for="setting2">
                            {{\App\Models\Permission::find(18)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==19)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(19)->id}}" id="setting3">
                        <label class="form-check-label" for="setting3">
                            {{\App\Models\Permission::find(19)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==20)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(20)->id}}" id="setting4">
                        <label class="form-check-label" for="setting4">
                            {{\App\Models\Permission::find(20)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==21)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(21)->id}}" id="setting5">
                        <label class="form-check-label" for="setting5">
                            {{\App\Models\Permission::find(21)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==22)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(22)->id}}" id="setting6">
                        <label class="form-check-label" for="setting6">
                            {{\App\Models\Permission::find(22)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==23)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(23)->id}}" id="setting7">
                        <label class="form-check-label" for="setting7">
                            {{\App\Models\Permission::find(23)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==24)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(24)->id}}" id="setting8">
                        <label class="form-check-label" for="setting8">
                            {{\App\Models\Permission::find(24)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==25)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(25)->id}}" id="setting9">
                        <label class="form-check-label" for="setting9">
                            {{\App\Models\Permission::find(25)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==26)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(26)->id}}" id="setting10">
                        <label class="form-check-label" for="setting10">
                            ط{{\App\Models\Permission::find(26)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==27)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(27)->id}}" id="setting11">
                        <label class="form-check-label" for="setting11">
                            {{\App\Models\Permission::find(27)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==28)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(28)->id}}" id="setting12">
                        <label class="form-check-label" for="setting12">
                            {{\App\Models\Permission::find(28)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==29)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(29)->id}}" id="setting13">
                        <label class="form-check-label" for="setting13">
                            {{\App\Models\Permission::find(29)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==30)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(30)->id}}" id="setting14">
                        <label class="form-check-label" for="setting14">
                            {{\App\Models\Permission::find(30)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]"  @foreach($admin->permissions as $permission)  @if($permission->id==31)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(31)->id}}" id="setting15">
                        <label class="form-check-label" for="setting15">
                            {{\App\Models\Permission::find(31)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==32)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(32)->id}}" id="setting16">
                        <label class="form-check-label" for="setting16">
                            {{\App\Models\Permission::find(32)->name}}
                        </label>
                    </div>
                </div>
            </div>
            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> المتجر الالكتروني </label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==33)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(33)->id}}" id="shop1">
                        <label class="form-check-label" for="shop1">
                            {{\App\Models\Permission::find(33)->name}}
                        </label>
                    </div>
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" type="checkbox" name="permissions[]" @foreach($admin->permissions as $permission)  @if($permission->id==34)  checked  @endif    @endforeach value="{{\App\Models\Permission::find(34)->id}}" id="shop2">
                        <label class="form-check-label" for="shop2">
                            {{\App\Models\Permission::find(34)->name}}
                        </label>
                    </div>
                </div>
            </div>

            <!--  checkbox -->
            <div class="d-flex align-items-center mb-4 ">
                <label class="form-label m-0" style="white-space: nowrap ;"> رسائل الشركات</label>
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
                <!-- inner -->
                <div class="d-flex align-items-center ms-3 flex-wrap">
                    <div class="form-check mx-3 my-2">
                        <input class="form-check-input" name="permissions[]"  @foreach($admin->permissions as $permission)  @if($permission->id==35)  checked  @endif    @endforeach type="checkbox" value="{{\App\Models\Permission::find(35)->id}}" id="mess1">
                        <label class="form-check-label" for="mess1">
                            {{\App\Models\Permission::find(35)->name}}
                        </label>
                    </div>

                </div>
            </div>
            <div class="d-flex align-content-center justify-content-end py-2">
                <button type="submit" class="btn orangeBtn px-5"> تعديل </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->









@endsection

@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.min.css')}}">

@endsection

@section('js')
    <script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>

    <script>
        $('.dropify').dropify();

    </script>
@endsection
