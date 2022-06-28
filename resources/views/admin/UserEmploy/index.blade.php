@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')
    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #modal-content {

            position: relative !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex !important;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #f1f5f7;
            border-radius: 0.4rem;
            outline: 0;
        }
        #modal-footer{
            position: absolute;
            bottom: -15%;
        }



    </style>


@endsection

@section('content')


    <div class="container-fluid">


        @include('admin.alerts.success')
        @include('admin.alerts.errors')
        <!-- modal -->
        <div class="modal fade" id="addEmployee" tabindex="-1" role="dialog"
             aria-labelledby="addEmployeeTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="mod-content">
                            <form action="{{route('admin.UserEmploy.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div  class="dropzone">
                                    <div class="fallback">
                                        <input name="photo" type="file">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="">
                                            <i class="display-6 fas mo-icon fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> إسم الموظف
                                            </label>
                                            <input class="form-control" type="text" id="default-input" name="name"
                                                   placeholder="ادخل اسم الموظف">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input">رقم الهوية</label>
                                            <input class="form-control" type="number" id="default-input"
                                                   placeholder="ادخل رقم الهوية" name="id_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> رقم الموظف
                                            </label>
                                            <input class="form-control" type="text" id="default-input" name="employ_number"
                                                   placeholder="ادخل رقم الموظف">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> تاريخ المباشرة
                                            </label>
                                            <input class="form-control" type="date" id="default-input" name="commencement_date"
                                                   placeholder="Default input">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> تاريخ إنتهاء
                                                الإقامة </label>
                                            <input class="form-control" type="date" id="default-input" name="expire_residence"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> رقم الجوال
                                            </label>
                                            <input class="form-control" type="text" id="default-input" name="phone"
                                                   placeholder="رقم الجوال">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> الراتب الشهري
                                            </label>
                                            <input class="form-control" type="number" id="default-input" name="salary"
                                                   placeholder="ادخل قيمة الراتب">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> حالة الموظف
                                            </label>
                                            <input class="form-control" type="text" id="default-input" name="status"
                                                   placeholder="منتظم">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> المسمى الوظيفي
                                            </label>
                                            <input class="form-control" type="text" id="default-input" name="job_title"
                                                   placeholder="ادخل المسمى الوظيفى">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> رصيد الأجازات
                                            </label>
                                            <input class="form-control" type="number" id="default-input" name="vacations"
                                                   placeholder="عدد ايام الاجازات">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> عدد أيام الغياب
                                            </label>
                                            <input class="form-control" type="number" id="default-input" name="absence"
                                                   placeholder="عدد ايام الغياب">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> البريد الإلكتروني
                                            </label>
                                            <input class="form-control" type="email" id="default-input" name="email"
                                                   placeholder="@gmail">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> عقد الموظف
                                            </label>
                                            <input class="form-control" type="file" id="default-input" name="contract"
                                                   placeholder="@gmail">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="default-input"> رقم الأيبان
                                            </label>
                                            <input class="form-control" type="number" id="default-input" name="ipan"
                                                   placeholder="رقم ال ipan">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer ">
                                    <div class="w-100 d-flex justify-content-between">
                                        <button type="button" class="btn stoped pdf mx-2" data-bs-dismiss="modal">
                                            download <i class="mx-1 far fa-file-pdf"></i> </button>
                                        <div class="">
                                            <button type="submit" class="btn stoped  mx-2"> حفظ التغييرات </button>
                                            <button type="button" class="btn stoped " data-bs-dismiss="modal"> إغلاق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- date -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div class="p-2">
                <button class="stoped" data-bs-toggle="modal" data-bs-target="#addEmployee">
                    <i class="fas fa-plus me-2"></i>
                    إضافة طلب
                </button>
            </div>
            <div class="d-flex flex-wrap justify-content-end mb-3">

                <div class="p-2">
                    <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="burn">
            <div class="table-responsive mb-0 rounded">
                <table id="datatable" class="table bg-white dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th> رقم الموظف </th>
                        <th> إسم الموظف </th>
                        <th> تاريخ المباشرة </th>
                        <th> الوظيفة </th>
                        <th> حالة الموظف </th>
                        <th> رصيد الأجازات </th>
                        <th> الراتب الشهري </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($UserEmploys)
                        @foreach($UserEmploys as $UserEmploy)
                    <tr>
                        <td> {{$UserEmploy->employ_number}} </td>
                        <td> {{$UserEmploy->name}} </td>
                        <td> {{$UserEmploy->commencement_date}} </td>
                        <td> {{$UserEmploy->job_title}}</td>
                        <td> {{$UserEmploy->status}} </td>
                        <td> {{$UserEmploy->vacations}} </td>
                        <td>{{$UserEmploy->salary}}  </td>
                        <td> <button class="stoped" data-bs-toggle="modal" data-bs-target="#updateEmployee"><i class=" far fa-file-alt me-1"></i> عرض
                                السجل </button> </td>
                    </tr>
                    <div class="modal fade" id="updateEmployee" tabindex="-1" role="dialog"
                         aria-labelledby="addEmployeeTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-body">

                                    <div class="mod-content">
                                        <form action="{{route('admin.UserEmploy.update',$UserEmploy->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div  class="dropzone">
                                                <div class="fallback">
                                                    <input name="photo" type="file" value="{{$UserEmploy->photo}}">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="">
                                                        <i class="display-6 fas mo-icon fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> إسم الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="name" value="{{$UserEmploy->name}}"
                                                               placeholder="ادخل اسم الموظف">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input">رقم الهوية</label>
                                                        <input class="form-control" type="number" id="default-input" value="{{$UserEmploy->id_number}}"
                                                               name="id_number"  placeholder="ادخل رقم الهوية">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="employ_number" value="{{$UserEmploy->employ_number}}"
                                                               placeholder="ادخل رقم الموظف">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> تاريخ المباشرة
                                                        </label>
                                                        <input class="form-control" type="date" id="default-input" name="commencement_date" value="{{$UserEmploy->commencement_date}}"
                                                               placeholder="Default input">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> تاريخ إنتهاء
                                                            الإقامة </label>
                                                        <input class="form-control" type="date" id="default-input" name="expire_residence" value="{{$UserEmploy->expire_residence}}"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الجوال
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="phone" value="{{$UserEmploy->phone}}"
                                                               placeholder="رقم الجوال">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> الراتب الشهري
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="salary" value="{{$UserEmploy->salary}}"
                                                               placeholder="ادخل قيمة الراتب">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> حالة الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="status" value="{{$UserEmploy->status}}"
                                                               placeholder="منتظم">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> المسمى الوظيفي
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="job_title" value="{{$UserEmploy->job_title}}"
                                                               placeholder="ادخل المسمى الوظيفى">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رصيد الأجازات
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="vacations" value="{{$UserEmploy->vacations}}"
                                                               placeholder="عدد ايام الاجازات">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> عدد أيام الغياب
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="absence" value="{{$UserEmploy->absence}}"
                                                               placeholder="عدد ايام الغياب">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> البريد الإلكتروني
                                                        </label>
                                                        <input class="form-control" type="email" id="default-input" name="email" value="{{$UserEmploy->email}}"
                                                               placeholder="@gmail">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> عقد الموظف
                                                        </label>
                                                        <input class="form-control" type="file" id="default-input" name="contract" value="{{$UserEmploy->contract}}"
                                                               placeholder="@gmail">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الأيبان
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="ipan" value="{{$UserEmploy->ipan}}"
                                                               placeholder="رقم ال ipan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="modal-footer">
                                                <div class="w d-flex justify-content-between">
                                                    <button type="button" class="btn stoped pdf mx-2" data-bs-dismiss="modal">
                                                        download <i class="mx-1 far fa-file-pdf"></i> </button>
                                                    <div class="">
                                                        <button type="submit" class="btn stoped  mx-2"> حفظ التغييرات </button>
                                                        <button type="button" class="btn stoped " data-bs-dismiss="modal"> إغلاق
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                        @endforeach
                    @endisset
                    </tbody>


                </table>
                <!--##############################################################################-->
                <!--##############################################################################-->
            </div>
        </div>

    </div>


@endsection
@section('js')

    <script src="{{asset('assets/admin/libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection


