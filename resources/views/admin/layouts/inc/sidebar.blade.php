<section>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <!-- <li class="menu-title">Menu</li> -->

                    <li>
                        <a href="{{route('admin.dashboard')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/speed-24px.png" width="20px" height="20ox" alt="">
                            <span> الرئيسية </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.sales_and_operation')}}" class=" waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/baseline-account_balance_wallet-24px.png" width="20px" height="20ox" alt="">
                            <span> المبيعات </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/Group 122.png" width="20px" height="20ox" alt="">
                            <span> الطلبات </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('orders.index')}}?month={{date('Y-m')}}"> جدول الطلبات </a></li>
                            <li><a href="{{route('available-times.index')}}">   الأوقات المتاحة </a></li>
                            <li><a href="{{route('monthly-subscription.index')}}?month={{date('Y-m')}}">   الإشتراكات الشهرية </a></li>
                            <li><a href="{{route('sent-services.index')}}"> الخدمات المرسلة </a></li>
                        </ul>
                    </li>

                    <!-- <li class="menu-title">Layouts</li> -->


                    <li>
                        <a href="{{route('admin.Apps')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/baseline-business_center-24px.png" width="20px" height="20ox" alt="">
                            <span> التطبيقات </span>
                        </a>

                    </li>

                    <li>
                        <a href="{{route('getoperation')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/manage_accounts_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> العمليات </span>
                        </a>

                    </li>

                    <!-- <li class="menu-title">Pages</li> -->

                    <li>
                        <a href="{{route('getdriverorder')}}" class=" waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/Group 384.png" width="20px" height="20ox" alt="">
                            <span> السائقين </span>
                        </a>

                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/paid_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> الشئون المالية </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="arrive-leave.html"> الحضور والإنصراف </a></li>
                            <li><a href="{{route('admin.UserEmploy')}}"> بيانات الموظفين </a></li>
                            <li><a href="{{route('admin.SalariesCommissions')}}"> الرواتب والعمولة </a></li>
                            <li><a href="car-reports.html"> تقارير السيارات </a></li>
                            <li><a href="{{route('admin.carPerformance.index')}}"> تقارير اداء السيارات </a></li>
                            <li><a href="apps-reports.html"> تقارير التطبيقات  </a></li>
                            <li><a href="financial-collection.html"> التحصيل المالي </a></li>
                            <li><a href="maintenance-reports.html"> تقارير الصيانة </a></li>
                            <li><a href="burnings.html"> المحروقات </a></li>
                            <li><a href="Administrative-expenses.html"> مصاريف إدارية </a></li>
                            <li><a href="financial-obligations.html"> الإلتزامات المالية </a></li>
                            <li><a href="{{route('admin.purchase.index')}}">  مشتريات    </a></li>
                            <li><a href="distressed-sums.html"> مبالغ متعثرة </a></li>
                            <li><a href="warehouse.html"> المستودع </a></li>
                        </ul>
                    </li>

                    <!-- <li class="menu-title">Components</li> -->

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/assessment_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> التقارير المالية </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="orders-reports.html"> تقارير الطلبات المنفذة  </a></li>
                            <li><a href="{{route('admin.cars.revenue')}}"> تقارير ايرادات السيارات    </a></li>

                            <li><a href="Revenues.html"> الإيرادات </a></li>
                            <li><a href="cost.html"> التكلفة </a></li>
                            <li><a href="company-profitability.html"> ربحية الشركة </a></li>
                            <li><a href="financial-savings.html">الإدخار</a></li>
                            <li><a href="financial-grouth.html"> النمو </a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="{{route('getallservices')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/local_offer_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> الباقات </span>
                        </a>

                    </li>

                    <li>
                        <a href="{{route('admin.appStatus')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/local_offer_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> حالة الموقع </span>
                        </a>

                    </li>




                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/phone_iphone_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> إعدادات التطبيق </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('getallservices')}}"> الخدمات </a></li>
                            <li><a href="{{route('getminsubservice')}}"> الخدمات الإضافية </a></li>
                            <li><a href="{{route('admin.AppSettingDrivers')}}"> السائقين  </a></li>
                            <li><a href="{{route('groups.index')}}"> المناطق والأحياء </a></li>
                            <li><a href="{{route('showperiods')}}"> الأوقات </a></li>
                            <li><a href="{{route('getcartype')}}"> أنواع السيارات </a></li>
                            <li><a href="{{route('getsubcartype')}}"> أنواع السيارات الفرعية </a></li>
                            <li><a href="{{route('getcoupons')}}"> أكواد الخصم </a></li>
                            <li><a href="{{route('getpaymentmethod')}}">  طرق الدفع </a></li>

                            <li><a href="{{route('getoffers')}}"> العروض </a></li>
                            <li><a href="{{route('getnotification')}}"> الإشعارات </a></li>
                            <li><a href="{{route('admin.AppSettingTerms')}}"> الشروط والأحكام </a></li>
                            <li><a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a></li>
                            <li><a href="{{route('admin.AppSettingSocial')}}"> وسائل التواصل الإجتماعي </a></li>
                            <li><a href="{{route('admin.AppSettingSupport')}}"> وسائل الدعم والمساعدة </a></li>



                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{asset('assets/admin/images/icons/baseline-shopping_cart-24px.svg')}}" alt="">
                            <span> المتجر الالكتروني </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{route('getproducts')}}">
                                    <img src="{{asset('assets/admin/images/icons/view_agenda_black_24dp.svg')}}" alt="">
                                    المنتجات
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.OnlineStoreCategories')}}">
                                    <img src="{{asset('assets/admin/images/icons/inventory_2_black_24dp.svg')}}" alt="">
                                    التصنيفات
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('admin.get.clients')}}" class="waves-effect">
                            <img src="{{asset('assets/admin/images/icons/clients.png')}}" alt="">
                            <span> العملاء </span>
                        </a>
                    </li>



                    <li>
                        <a href="{{route('admin.ContactMail')}}" class="waves-effect">
                            <img src="{{asset('assets/admin/images/icons/contact_mail_black_24dp.svg')}}" alt="">
                            <span> رسائل الشركات </span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</section>
