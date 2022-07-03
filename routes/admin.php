<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'AdminController@index')
    ->name('admin.dashboard');
Route::get('admin/lang/{lang}', function ($lang) {
    if (in_array($lang, ['ar', 'en', 'es'])) {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
    } else { // end of array
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', 'en');
    }
    return back();
});
///////////////////////////////rotes elsdodey //////////////////////////
Route::get('exportorders','ExportController@exportorders')->name('exportorders');
Route::get('allservices','ServiceController@getservices')->name('getallservices');
Route::get('edit/service/{id}','ServiceController@editservice')->name('editservice');
Route::post('update/service/{id}','ServiceController@updateservice')->name('updateservice');
Route::get('change/servicestatus','ServiceController@changeservicevisibility')->name('changeservicevisibility');
Route::get('getsubservice/service/{id}','ServiceController@getsubserviceformainservice')->name('getsubserviceformainservice');
Route::get('deletesubservice','ServiceController@deletesubservice')->name('deletesubservice');

Route::get('edite/subserivce/{id}','ServiceController@editsubservice')->name('editsubservice');
Route::get('create/subservice/{id}','ServiceController@createsubservice')->name('createsubservice');

Route::post('update/subservice/{id}','ServiceController@updatesubservice')->name('updatesubservice');
Route::post('add/subservice/{id}','ServiceController@addsubservice')->name('addsubservice');

/////////////////////////////الخدمات الاضافية/////////////////////////////

Route::get('get/minsubservice','ServiceController@getminsubservice')->name('getminsubservice');

Route::get('create/minsubservice','ServiceController@createminsubservice')->name('createminsubservice');

Route::get('edit/minsubservice/{id}','ServiceController@editminsubservice')->name('editminsubservice');

Route::post('update/minsubservice/{id}','ServiceController@updateminsubservice')->name('updateminsubservice');

Route::post('add/minsubservice','ServiceController@addminsubservice')->name('addminsubservice');



///////////////////////////////////////المناطق والاحياء///////////////////////////////////

Route::get('get/regions','GroupController@index')->name('groups.index');

Route::get('create/region','GroupController@createregion')->name('createregion');
Route::post('add/region','GroupController@addregion')->name('addregion');

Route::get('edit/region/{id}','GroupController@editregion')->name('editregion');
Route::post('update/region/{id}','GroupController@updateregion')->name('updateregion');

Route::get('get/regiondetails/{id}','GroupController@getregiondetails')->name('getregiondetails');

Route::get('delete/region/{id}','GroupController@deleteRegion')->name('admin.deleteRegion');


////////////////////////////////////////الفترات////////////////////////

Route::post('createorupdate/periods-days/forregion/{id}','DayPeriodController@createorupdateregionperiodandday')->name('createorupdateregionperiodandday');

//////////////////////////////// الاحياء /////////////////////////////////////////////////

Route::get('delete/place','PlaceController@deleteplace')->name('deleteplace');

Route::get('place/changestatus','PlaceController@placechangestatus')->name('placechangestatus');

Route::get('edit/place/{id}','PlaceController@editplace')->name('editplace');

Route::post('update/place/{id}','PlaceController@updateplace')->name('updateplace');

Route::get('create/placeto/region/{id}','PlaceController@createplcetoregion')->name('createplcetoregion');

Route::post('add/placeto/region/{id}','PlaceController@addplacetoregion')->name('addplacetoregion');

/////////////////////////////////////////////////////periodlimit/////////////////////////////////////////

Route::get('get/times','TimeController@index')->name('showperiods');

Route::get('create/time','TimeController@createtime')->name('createtime');
Route::post('add/time','TimeController@addtime')->name('addtime');

Route::get('time/delete','TimeController@deletetime')->name('deletetime');

Route::get('edit/time/{id}','TimeController@edittime')->name('edittime');

Route::post('update/time/{id}','TimeController@updatetime')->name('updatetime');

////////////////////////////////////////////////////cars///////////////////////////////////////////////////////

Route::get('get/cartype','CarController@getcartype')->name('getcartype');
Route::get('create/maincar','CarController@createmaincar')->name('createmaincar');
Route::post('add/maincar','CarController@addmaincar')->name('addmaincar');

Route::get('edit/car/{id}','CarController@editmaincar')->name('editmaincar');

Route::post('update/car/{id}','CarController@updatemaincar')->name('updatemaincar');

Route::get('delete/car','CarController@deletemaincar')->name('deletemaincar');


/////////subcar/////

Route::get('get/subcartype','CarController@getsubcartype')->name('getsubcartype');

Route::get('create/subtypecar','CarController@createsubtypecar')->name('createsubtypecar');
Route::post('add/subtypecar','CarController@addsubtypecar')->name('addsubtypecar');

Route::get('edit/subtypecar/{id}','CarController@editsubcar')->name('editsubcar');

Route::post('update/subtypecar/{id}','CarController@updatesubcar')->name('updatesubcar');


/////////////////////////////////////////////////////////////////////offers////////////////////////////////////////////////////

Route::get('get/offers','OfferController@getoffers')->name('getoffers');

Route::get('create/offer','OfferController@createoffer')->name('createoffer');

Route::post('add/offer','OfferController@addoffer')->name('addoffer');

Route::get('delete/offer','OfferController@deleteoffer')->name('deleteoffer');


Route::get('edit/offer/{id}','OfferController@editoffer')->name('editoffer');

Route::post('update/offer/{id}','OfferController@updateoffer')->name('updateoffer');

//////////////////////////////////////////////Payment Method  /////////////////////////////////

Route::get('get/paymentMethod','PaymentController@getpaymentmethod')->name('getpaymentmethod');


Route::get('create/paymentMethod','PaymentController@cretepayment')->name('cretepayment');

Route::post('add/paymentMethod','PaymentController@addpayment')->name('addpayment');


Route::get('delete/paymentMethod','PaymentController@deletepayment')->name('deletepayment');

Route::get('change/paymentstatus','PaymentController@changepaymentstatus')->name('changepaymentstatus');


Route::get('edit/paymentMethod/{id}','PaymentController@editpayment')->name('editpayment');

Route::post('update/paymentMethod/{id}','PaymentController@updatepayment')->name('updatepayment');


/////////////////////////////////////////////// coupons//////////////////////////////////////////////////

Route::get('get/coupons','CouponController@getcoupons')->name('getcoupons');

Route::get('create/coupon','CouponController@createcoupon')->name('createcoupon');
Route::post('add/coupon','CouponController@addcoupon')->name('addcoupon');

Route::get('change/couponestatus','CouponController@changecouponstatus')->name('changecouponstatus');

//////////////////////////////////////////////  Notifications ////////////////////////////////////////////// ///////////////////



Route::get('get/notification','NotificationController@getnotification')->name('getnotification');

Route::get('delete/notification','NotificationController@deletenotification')->name('deletenotification');


Route::get('create/notification','NotificationController@createnotification')->name('createnotification');

Route::post('send/notification','NotificationController@adminsendnotification')->name('adminsendnotification');



//////////////////////////////////////////////////////////////Products//////////////////////////////////////////////////////////

Route::get('get/products','ProductController@getproducts')->name('getproducts');


Route::get('create/product','ProductController@createproduct')->name('createproduct');

Route::post('add/product','ProductController@addproduct')->name('addproduct');

Route::get('delete/product','ProductController@deleteproduct')->name('deleteproduct');

Route::get('edit/product/{id}','ProductController@editproduct')->name('editproduct');

Route::post('update/product/{id}','ProductController@updateproduct')->name('updateproduct');


Route::post('products/search','ProductController@productsearch')->name('productsearch');


///////////////////////////////////////////////////////////   drivers //////////////////////////////////////////////////////
Route::get('get/driver-order','DriverController@getdriverorder')->name('getdriverorder');


/////////////////////////////////////////////////  operation    ////////////////////////////////


Route::get('get/operation','OperationController@getoperation')->name('getoperation');
Route::get('get/carTrack','OperationController@carTrack')->name('carTrack');

Route::get('search/operation','OperationController@searcbymobile')->name('searcbymobile');


Route::get('delete/order','OperationController@deleteorder')->name('deleteorder');

Route::get('show/order','OperationController@showorder')->name('showorder');


Route::get('getsubcarbymaincar','OperationController@getsubcarbymaincar')->name('getsubcarbymaincar');

Route::post('updateorderbyadmin','OperationController@updateorderbyadmin')->name('updateorderbyadmin');

Route::get('changedriver','OperationController@changedriver')->name('changedriver');
/////////////////////////////////////////////////clients //////////////////////////////////////////////////


Route::get('get/clients','ClientController@getClients')->name('admin.get.clients');

Route::get('client/profile/{id}','ClientController@profile')->name('admin.client.profile');

Route::get('client/profile/filter/{id}','ClientController@filterProfileByDate')->name('admin.client.profile.filter.date');

Route::get('changeVip','ClientController@changeVip')->name('admin.client.change.vip');

Route::get('changeActive','ClientController@changeActive')->name('admin.client.change.active');

Route::get('change/vip/discount','ClientController@changeVipDiscount')->name('admin.change.vipDiscount');

Route::get('git/clients/{key}','ClientController@getClientsByFilter')->name('admin.getClientsByFilter');

Route::get('client/search/phone','ClientController@searchByMobile')->name('admin.search.client.mobile');

Route::get('client/search/places','ClientController@searchByPlace')->name('admin.search.client.place');

Route::get('client/search/date','ClientController@searchByDate')->name('admin.search.client.date');

Route::get('client/search/countOrder','ClientController@searchByCountOrder')->name('admin.search.client.count.order');

Route::get('client/search/service','ClientController@searchByService')->name('admin.search.client.service');

Route::get('export/users/excel','ExportController@exportUsers')->name('admin.export.user');

Route::get('client/search/payment','ClientController@clientSearchByPayment')->name('admin.client.search.payment');

Route::get('add/client/balance','ClientController@addBalanceToClient')->name('admin.client.add.balance');

Route::get('change/percentage','ClientController@changePercentage')->name('admin.client.change.percentage');



/////////////////////////////////////////////    المشتريات   //////////////////////////////////////////////////////

Route::get('get/purchase','PurchaseController@index')->name('admin.purchase.index');

Route::get('delete/purchase','PurchaseController@delete')->name('admin.purchase.delete');

Route::get('create/purchase','PurchaseController@create')->name('admin.purchase.create');
Route::post('add/purchase','PurchaseController@add')->name('admin.purchase.add');

Route::get('edit/purchase/{id}','PurchaseController@edit')->name('admin.purchase.edit');
Route::post('update/purchase/{id}','PurchaseController@update')->name('admin.purchase.update');

Route::get('export/purchases/excel','ExportController@exportPurchases')->name('admin.export.purchase');

////////////////////////////////////  CAR_PERFORMANCE    /////////////////////////////////////////////////



Route::get('get/carPerformance','CarPerformanceController@index')->name('admin.carPerformance.index');

Route::get('carPerformance/searchByMobile/SearchByOrderNumber/{search}','CarPerformanceController@search')->name('admin.carPerformance.search');

Route::get('carPerformance/searchByDate/{date}','CarPerformanceController@searchByDate')->name('admin.carPerformance.searchByDate');

Route::get('carPerformance/searchByCar/{car}','CarPerformanceController@searchByCar')->name('admin.carPerformance.searchByCar');

Route::get('export/CarPerformance/excel','ExportController@exportCarPerformance')->name('admin.export.CarPerformance');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('get/app/status','AppStatusController@index')->name('admin.appStatus');

Route::get('get/app/searchByDate/{date}','AppStatusController@filterByDate')->name('admin.app.filter.date');

Route::get('get/app/searchByMobile/{search}','AppStatusController@filterBySearch')->name('admin.app.filter.search');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('get/car/revenue','RevenueController@index')->name('admin.cars.revenue');

Route::get('car/revenue/filterByCar/{car}','RevenueController@searchByCar')->name('admin.revenue.search.car');

/////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('get/daysForParticipation','ParticipationController@getDays')->name('admin.participation.day');

Route::get('add/participation','ParticipationController@addParticipation')->name('admin.add.participation');

Route::get('get/orderdetails','ParticipationController@getOrderDeatails')->name('admin.order.participation.details');


Route::get('get/participation/filter/ByDate','ParticipationController@participationByDate')->name('admin.participation.filterByDate');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Route::middleware(['Lang'])->group(function () {
        Config::set('auth.defines', 'admin');
        /*====================Start Admin Auth System==================*/
        Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'AdminLoginController@login')->name('admin.login.submit');
        /*====================End Admin Auth System==================*/
        /*====================Admin Panel==================*/
        Route::group(['middleware' => 'admin:admin'], function () {
            /*================LogOut===========*/
            Route::post('logout/', 'AdminLoginController@logout')->name('admin.logout');
            /*================Admin Home =========================*/
            Route::get('/', 'AdminController@index')->name('admin.dashboard');
            Route::get('/sales-and-operation', 'AdminController@sales_and_operation')->name('admin.sales_and_operation');
            Route::post('update-target-setting', 'AdminController@update_target_setting')->name('admin.update_target_setting');
            /*================Admin Home =========================*/
            /*================Admin Setting control =========================*/
            Route::resource('setting', 'AdminSettingController');//setting
            //site texts
            Route::resource('siteTexts', 'AdminTextController');
            Route::post('siteTexts/delete', 'AdminTextController@delete')->name('siteTexts.delete');
            //Social
            Route::resource('socials', 'AdminSocialController');
            Route::post('socials/delete', 'AdminSocialController@delete')->name('socials.delete');
            //Slider
            Route::resource('sliders', 'AdminSliderController');
            Route::post('sliders/delete', 'AdminSliderController@delete')->name('sliders.delete');
            //Contacts
            Route::resource('contacts', 'AdminContactController');
            Route::post('contacts/delete', 'AdminContactController@delete')->name('contacts.delete');
            Route::get('contacts/email/{id}', 'AdminContactController@email_view')->name('contacts.email');
            Route::post('contacts/email', 'AdminContactController@send_Email')->name('contacts.send');
            //firbase Notification
            Route::resource('FirebaseNotification', 'AdminFirebaseNotificationController');
            //snd email to enyone
            Route::resource('adminEmails', 'SendEmailController');
            Route::post('adminEmails/email', 'SendEmailController@send_Email')->name('adminEmails.send');
            /*================Admin Setting control =========================*/
            /*================Admin Profile control =========================*/
            Route::resource('profile', 'AdminProfileController');
            Route::get('profile/password/{id}', 'AdminProfileController@update_pass_view')->name('profile.change.pass.view');
            Route::post('profile/password/change', 'AdminProfileController@update_pass')->name('profile.change.pass');
            /*================Admin Admin control =========================*/
            Route::resource('admins', 'AdminAdminController');
            Route::post('admins/delete', 'AdminAdminController@delete')->name('admins.delete');
            /*================Admin Users control =========================*/
            Route::resource('users', 'AdminUserController');
            Route::post('users/delete', 'AdminUserController@delete')->name('users.delete');
            Route::get('users/active/{id}', 'AdminUserController@is_active')->name('users.active');
            /*================Admin Drivers control =========================*/
            Route::resource('drivers', 'AdminDriverController');
            Route::post('drivers/delete', 'AdminDriverController@delete')->name('drivers.delete');
            Route::get('drivers/active/{id}', 'AdminDriverController@is_active')->name('drivers.active');
            /*================Admin Emplyee control =========================*/
            Route::resource('employees', 'AdminEmployeeController');
            Route::post('employees/delete', 'AdminEmployeeController@delete')->name('employees.delete');
            Route::get('employees/active/{id}', 'AdminEmployeeController@is_active')->name('employees.active');
            /*================Admin Marketer control =========================*/
            Route::resource('marketers', 'AdminMarketerController');
            Route::post('marketers/delete', 'AdminMarketerController@delete')->name('marketers.delete');
            Route::get('marketers/active/{id}', 'AdminMarketerController@is_active')->name('marketers.active');
            /*================Admin Packages control =========================*/
            Route::resource('packages', 'AdminPackageController');
            Route::post('packages/delete', 'AdminPackageController@delete')->name('packages.delete');
            /*================Admin carSizes control =========================*/
            Route::resource('carSizes', 'AdminCarSizeController');
            Route::post('carSizes/delete', 'AdminCarSizeController@delete')->name('carSizes.delete');
            /*================Admin carTypes control =========================*/
            Route::resource('subCarTypes', 'AdminSubTypesController');
            Route::post('subCarTypes/delete', 'AdminSubTypesController@delete')->name('subCarTypes.delete');
            /*================Admin sub carTypes control =========================*/
            Route::resource('carTypes', 'AdminCarTypeController');
            Route::post('carTypes/delete', 'AdminCarTypeController@delete')->name('carTypes.delete');
            /*================Admin cancel Reasons control =========================*/
            Route::resource('cancels', 'AdminCancelReasonController');
            Route::post('cancels/delete', 'AdminCancelReasonController@delete')->name('cancels.delete');
            /*================Admin Services control =========================*/
            Route::resource('services', 'AdminServicesController');
            Route::post('services/delete', 'AdminServicesController@delete')->name('services.delete');
            /*================Admin sub Services control =========================*/
            Route::resource('subServices', 'AdminSubServiceController');
            Route::post('subServices/delete', 'AdminSubServiceController@delete')->name('subServices.delete');
            /*================Admin sub sub Services control =========================*/
            Route::resource('subSubServices', 'AdminSubSubServiceController');
            Route::post('subSubServices/delete', 'AdminSubSubServiceController@delete')->name('subSubServices.delete');
            /*================Admin offers =========================*/
            Route::resource('offers', 'AdminOfferController');
            Route::post('offers/delete', 'AdminOfferController@delete')->name('offers.delete');
            /*================Admin workTime =========================*/
            Route::resource('workTimes', 'AdminWorkTimeController');
            Route::post('workTimes/delete', 'AdminWorkTimeController@delete')->name('workTimes.delete');
            /*================Admin DateTimes =========================*/
            Route::resource('dateTimes', 'AdminDateTimeController');
            Route::post('dateTimes/delete', 'AdminDateTimeController@delete')->name('dateTimes.delete');
            Route::get('dateTimes/active/{id}', 'AdminDateTimeController@is_active')->name('dateTimes.active');
            /*================Admin Question Controller =========================*/
            Route::resource('questions', 'QuestionController');
            Route::post('questions/delete', 'QuestionController@delete')->name('questions.delete');
            /*================Admin Orders Controller =========================*/
            Route::resource('orders', 'AdminOrderController');
            Route::get('orders-dailyOrder', 'AdminOrderController@dailyOrder')->name('orders.dailyOrder');
            Route::POST('orders-dailyOrder-save', 'AdminOrderController@dailyOrderSave')->name('orders.dailyOrder.save');
            Route::get('orders-showInformation/{id}', 'AdminOrderController@showInformation')->name('orders.showInformation');
            Route::get('orders-anotherMonth', 'AdminOrderController@anotherMonth')->name('orders.anotherMonth.index');
            Route::post('orders-driver-insert', 'AdminOrderController@insertDriver')->name('orders.driver.insert');

            /*================Admin Coupons Controller =========================*/
            Route::resource('coupons', 'AdminCouponController');
            Route::post('coupons/delete', 'AdminCouponController@delete')->name('coupons.delete');
            Route::get('coupons/active/{id}', 'AdminCouponController@is_active')->name('coupons.active');
            /*================Admin Payments Controller =========================*/
            Route::resource('payments', 'AdminPaymentController');
            Route::get('payments/finish/{id}', 'AdminPaymentController@is_finish')->name('payments.finish');
            /*================Admin Prices control =========================*/
            Route::resource('prices', 'AdminPriceController');
            Route::post('prices/delete', 'AdminPriceController@delete')->name('prices.delete');
            /*=======================AdminDailyOrderCountController=================*/
            Route::resource('order-counts', 'AdminDailyOrderCountController');
            // Route::post('order-counts/delete','AdminDailyOrderCountController@delete')->name('prices.delete');
            /*=======================AdminMonthlyOrderCountController=================*/
            Route::resource('order-monthly', 'AdminMonthlyServiceController');
            Route::get('test', function () {
                return strtotime('6/5/2019');
            });

        //====================== newRoutes //////////////
            require __DIR__ . '/newRoutes/admin.php';
        });
        /*====================End Admin Panel==================*/
//});//end middleware of language
