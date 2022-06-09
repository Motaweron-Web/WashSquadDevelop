@extends('admin.layouts.inc.app')

@section('content')



    <div class="container-fluid">
        <!-- date -->
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2 col-4">
                <input type="search" class="form-control searchInput"
                       placeholder="phone number .. order number">
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg">
                    <option selected>Today </option>
                    <option value="1">This week</option>
                    <option value="2">Last week</option>
                    <option value="3">This month</option>
                    <option value="4">This year</option>
                </select>
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg">
                    <option selected> January </option>
                    <option value="1"> February </option>
                    <option value="2"> March </option>
                    <option value="3"> April </option>
                </select>
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg">
                    <option selected>2022</option>
                    <option value="1">2021</option>
                    <option value="2">2020</option>
                    <option value="3">2019</option>
                </select>
            </div>
        </div>
        <!-- Map -->
        <div class="gps">
            <h4 class="operation-head"> خريطة الطلبات </h4>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d929379.4602443745!2d46.53355629405653!3d24.50663524780021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2z2KfZhNiz2LnZiNiv2YrYqQ!5e0!3m2!1sar!2seg!4v1618065211283!5m2!1sar!2seg"
                width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- count -->
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs purble">
                    <h5 class="text-white"> طلبات جديدة <i class="fas fa-mobile-alt px-1"></i> </h5>
                    <span>6</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs yelo">
                    <h5 class="text-white"> السائق بالطريق <i class="fas fa-car-alt px-1"></i> </h5>
                    <span>6</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs blu">
                    <h5 class="text-white"> جاري العمل <i class="fas fa-cloud-moon px-1"></i> </h5>
                    <span>6</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs gry">
                    <h5 class="text-white"> إنتهى العمل <i class="far fa-clock px-1"></i> </h5>
                    <span>6</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs gren">
                    <h5 class="text-white"> تمت الخدمة <i class="fas fa-mobile-alt px-1 "></i> </h5>
                    <span>6</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
                <div class="cols-divs rd">
                    <h5 class="text-white"> طلبات ملغية <i class="far fa-times-circle px-1"></i> </h5>
                    <span>6</span>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                <table id="datatable-buttons" class="table dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th> رقم الطلب </th>
                        <th> تاريخ الطلب </th>
                        <th> الوقت </th>
                        <th> المزود </th>
                        <th> العدد </th>
                        <th> نوع الخدمة </th>
                        <th> الباقة </th>
                        <th> خدمة إضافة </th>
                        <th> الحي </th>
                        <th> إسم العميل </th>
                        <th> رقم الجوال </th>
                        <th> الماركة </th>
                        <th> الإجمالي </th>
                        <th> السائق </th>
                        <th> الموقع </th>
                        <th> فاتورة </th>
                        <th> إعدادات </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="purble big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="purble big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="purble big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="purble big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gry big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gry big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gry big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gry big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gry big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="yelo big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="yelo big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="yelo big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="yelo big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="yelo big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="blu big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gren big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gren big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gren big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="gren big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="rd big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="rd big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    <tr class="rd big-border-p text-white">
                        <td> 10872 </td>
                        <td> 2021/07/13 </td>
                        <td> 06:00 </td>
                        <td> wash </td>
                        <td> 2 </td>
                        <td> غسيل </td>
                        <td> اشتراك </td>
                        <td> تلميع مكينة </td>
                        <td> الروضة </td>
                        <td> محمد </td>
                        <td> 0586877977 </td>
                        <td> مازدا </td>
                        <td> 250SR </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled> إختر السائق </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                                <option value=""> محمد </option>
                            </select>
                        </td>
                        <td> <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="cursor: pointer;"> <i class="fas fa-map-marker-alt"></i>
                            </a> </td>
                        <td> <a> <i class="fas fa-file-pdf"></i> </a> </td>
                        <td>
                            <i class="dripicons-information px-1"></i>
                            <i class="far fa-edit px-1"></i>
                            <i class="far fa-trash-alt text-danger px-1"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>















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

@endsection

