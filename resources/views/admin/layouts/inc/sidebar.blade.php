<section>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <!-- <li class="menu-title">Menu</li> -->
                    @if(checkPermission(1)  )
                    <li>
                        <a href="{{route('admin.dashboard')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/speed-24px.png" width="20px" height="20ox" alt="">
                            <span> الرئيسية </span>
                        </a>
                    </li>
                    @endif
                    @if(checkPermission(2)  )
                    <li>
                        <a href="{{route('admin.sales_and_operation')}}" class=" waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/baseline-account_balance_wallet-24px.png" width="20px" height="20ox" alt="">
                            <span> المبيعات </span>
                        </a>
                    </li>
                    @endif
                    @if(checkPermission(3) || checkPermission(4) || checkPermission(5) || checkPermission(6))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/Group 122.png" width="20px" height="20ox" alt="">
                            <span> الطلبات </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(checkPermission(3)  )
                            <li><a href="{{route('orders.index')}}?month={{date('Y-m')}}"> جدول الطلبات </a></li>
                            @endif
                                @if(checkPermission(4)  )
                                <li><a href="{{route('available-times.index')}}">   الأوقات المتاحة </a></li>
                                @endif
                                @if(checkPermission(5)  )
                                <li><a href="{{route('monthly-subscription.index')}}?month={{date('Y-m')}}">   الإشتراكات الشهرية </a></li>
                                @endif
                                @if(checkPermission(6)  )
                                    <li><a href="{{route('sent-services.index')}}"> الخدمات المرسلة </a></li>
                                @endif
                        </ul>
                    </li>
                    @endif
                    <!-- <li class="menu-title">Layouts</li> -->

                    @if(checkPermission(7)  )

                    <li>
                        <a href="{{route('admin.Apps')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/baseline-business_center-24px.png" width="20px" height="20ox" alt="">
                            <span> التطبيقات </span>
                        </a>

                    </li>
                    @endif
                    @if(checkPermission(8)  )
                    <li>
                        <a href="{{route('getoperation')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/manage_accounts_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> العمليات </span>
                        </a>

                    </li>
                    @endif

                    <!-- <li class="menu-title">Pages</li> -->
                    @if(checkPermission(9)  )
                    <li>
                        <a href="{{route('getdriverorder')}}" class=" waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/Group 384.png" width="20px" height="20ox" alt="">
                            <span> السائقين </span>
                        </a>

                    </li>
                    @endif
                    @if(checkPermission(10) || checkPermission(11) || checkPermission(12) )
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/paid_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> الشئون المالية </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(checkPermission(10)  )
                            <li><a href="{{route('admin.UserEmploy')}}"> بيانات الموظفين </a></li>
                            @endif
                                @if(checkPermission(11)  )
                                <li><a href="{{route('admin.SalariesCommissions')}}"> الرواتب والعمولة </a></li>
                                @endif
                                @if(checkPermission(12)  )
                                <li><a href="{{route('admin.purchase.index')}}">  مشتريات    </a></li>
                                @endif
                        </ul>
                    </li>
                    @endif
                    <!-- <li class="menu-title">Components</li> -->
                    @if(checkPermission(13) || checkPermission(14) || checkPermission(15) )
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/assessment_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> التقارير المالية </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(checkPermission(13)  )
                            <li><a href="{{route('admin.get.order.report')}}"> تقارير الطلبات   </a></li>
                            @endif
                                @if(checkPermission(14)  )
                                <li><a href="{{route('admin.cars.revenue')}}"> تقارير ايرادات السيارات    </a></li>
                                @endif
                                @if(checkPermission(15)  )
                            <li><a href="{{route('admin.carPerformance.index')}}"> تقارير اداء السيارات </a></li>
                                @endif
                        </ul>
                    </li>
                    @endif
                    @if(checkPermission(16)  )
                    <li>
                        <a href="{{route('admin.get.clients')}}" class="waves-effect">
                            <img src="{{asset('assets/admin/images/icons/clients.png')}}" alt="">
                            <span> العملاء </span>
                        </a>
                    </li>
                    @endif
                    @if(checkPermission(17) || checkPermission(18) || checkPermission(19) || checkPermission(20) || checkPermission(21)|| checkPermission(22) || checkPermission(23)|| checkPermission(24) || checkPermission(25)|| checkPermission(26) || checkPermission(27)|| checkPermission(28) || checkPermission(29)|| checkPermission(30) || checkPermission(31)|| checkPermission(32))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/phone_iphone_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> إعدادات التطبيق </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(checkPermission(17)  )
                            <li><a href="{{route('getallservices')}}"> الخدمات </a></li>
                            @endif
                                @if(checkPermission(18)  )
                                <li><a href="{{route('getminsubservice')}}"> الخدمات الإضافية </a></li>
                                @endif
                                @if(checkPermission(20)  )
                                <li><a href="{{route('admin.AppSettingDrivers')}}"> السائقين  </a></li>
                                @endif
                                @if(checkPermission(19)  )
                                <li><a href="{{route('groups.index')}}"> المناطق والأحياء </a></li>
                                @endif
                                @if(checkPermission(21)  )
                                <li><a href="{{route('showperiods')}}"> الأوقات </a></li>
                                @endif
                                @if(checkPermission(23)  )
                                <li><a href="{{route('getcartype')}}"> أنواع السيارات </a></li>
                                @endif
                                @if(checkPermission(24)  )
                                <li><a href="{{route('getsubcartype')}}"> أنواع السيارات الفرعية </a></li>
                                @endif
                                @if(checkPermission(25)  )
                                <li><a href="{{route('getcoupons')}}"> أكواد الخصم </a></li>
                                @endif
                                @if(checkPermission(26)  )
                                <li><a href="{{route('getpaymentmethod')}}">  طرق الدفع </a></li>
                                @endif
                                @if(checkPermission(27) )
                                <li><a href="{{route('getoffers')}}"> العروض </a></li>
                                @endif
                                @if(checkPermission(28) )
                                <li><a href="{{route('getnotification')}}"> الإشعارات </a></li>
                                @endif
                                @if(checkPermission(29) )
                                <li><a href="{{route('admin.AppSettingTerms')}}"> الشروط والأحكام </a></li>
                                @endif
                                @if(checkPermission(30) )
                                <li><a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a></li>
                                @endif
                                @if(checkPermission(31) )
                                <li><a href="{{route('admin.AppSettingSocial')}}"> وسائل التواصل الإجتماعي </a></li>
                                @endif
                                @if(checkPermission(32) )

                                <li><a href="{{route('admin.AppSettingSupport')}}"> وسائل الدعم والمساعدة </a></li>
                                @endif


                        </ul>
                    </li>
                    @endif
<!--
                    <li>
                        <a href="{{route('getallservices')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/local_offer_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> الباقات </span>
                        </a>

                    </li>
                    -->
<!--
                    <li>
                        <a href="{{route('admin.appStatus')}}" class="waves-effect">
                            <img src="{{url('assets/admin')}}/images/icons/local_offer_black_24dp.png" width="20px" height="20ox" alt="">
                            <span> حالة الموقع </span>
                        </a>

                    </li>
-->



                    @if(checkPermission(33) || checkPermission(34)  )

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <img src="{{asset('assets/admin/images/icons/baseline-shopping_cart-24px.svg')}}" alt="">
                            <span> المتجر الالكتروني </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(checkPermission(33) )
                            <li>
                                <a href="{{route('getproducts')}}">
                                    <img src="{{asset('assets/admin/images/icons/view_agenda_black_24dp.svg')}}" alt="">
                                    المنتجات
                                </a>
                            </li>
                            @endif
                                @if(checkPermission(34) )
                                <li>
                                <a href="{{route('admin.OnlineStoreCategories')}}">
                                    <img src="{{asset('assets/admin/images/icons/inventory_2_black_24dp.svg')}}" alt="">
                                    التصنيفات
                                </a>
                            </li>
                                @endif
                        </ul>
                    </li>
                    @endif


                    @if(checkPermission(35) )
                    <li>
                        <a href="{{route('admin.ContactMail')}}" class="waves-effect">
                            <img src="{{asset('assets/admin/images/icons/contact_mail_black_24dp.svg')}}" alt="">
                            <span> رسائل الشركات </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</section>
