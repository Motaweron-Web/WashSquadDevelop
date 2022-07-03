@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')


@endsection

@section('content')


    <div class="page-content">
        <!-- date -->
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2">
                <select class="form-select ">
                    <option selected disabled> حالة الطلب </option>
                    <option value="1"> مكتملة  </option>
                    <option value="2"> ملغية  </option>
                    <option value="3"> جديد  </option>
                </select>
            </div>
            <div class="p-2 col-4">
                <input type="date" class="form-control ">
            </div>

            <div class="p-2">
                <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </button>
            </div>
        </div>
        <!-- table -->
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق ووش سكواد </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق غسيل </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سـرور </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سـرور </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سـرور </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سـرور </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سـرور </h2>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب </th>
                            <th> تاريخ الطلب </th>
                            <th> الوقت </th>
                            <th> المزود </th>
                            <th> العدد </th>
                            <th> نوع الخدمة </th>
                            <th> الباقة </th>
                            <th> خدمة اضافة </th>
                            <th> الحى </th>
                            <th> اسم العميل </th>
                            <th> رقم الجوال </th>
                            <th> الاجمالي </th>
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 10872 </td>
                            <td> 2021/07/13 </td>
                            <td> 06:00 </td>
                            <td> wash </td>
                            <td> 2 </td>
                            <td> غسيل </td>
                            <td> بخار </td>
                            <td> تلميع مكينة </td>
                            <td> الروضة </td>
                            <td> محمد</td>
                            <td> 045684684 </td>
                            <td> 0 SR </td>
                            <td> 1656 </td>
                            <td> cash </td>
                            <td> <button class="active"> Complete </button> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




@endsection
  @section('js')


@endsection

