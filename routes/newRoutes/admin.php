<?php
use Illuminate\Support\Facades\Route;

////////////////////////  الأوقات المتاحه //////////////////////
Route::resource('available-times', 'AvailableTimesController');
Route::get('available-times-anotherMonth', 'AvailableTimesController@anotherMonth')->name('available-times.anotherMonth.index');

/////////////////// الإشتراكات الشهرية //////////////////////
Route::resource('monthly-subscription', 'MonthlySubscriptionController');
Route::get('monthly-subscription-anotherMonth', 'MonthlySubscriptionController@anotherMonth')
    ->name('monthly-subscription.anotherMonth.index');

Route::resource('sent-services', 'SentServicesController');


########################################== mustafaELtatawy     ==################################################
########################################== app_setting_drivers ==################################################

Route::group(['prefix'=>'app_setting_drivers'],function(){
    Route::get('/','UserController@index')->name('admin.AppSettingDrivers');
    Route::get('creat','UserController@creat')->name('admin.AppSettingDrivers.creat');
    Route::post('store','UserController@store')->name('admin.AppSettingDrivers.store');
    Route::get('edit/{id}','UserController@edit')->name('admin.AppSettingDrivers.edit');
    Route::post('update/{id}','UserController@update')->name('admin.AppSettingDrivers.update');
    Route::get('delete/{id}','UserController@destroy')->name('admin.AppSettingDrivers.delete');
});


Route::get('get/details/appDriver','UserController@driverDetails')->name('admin.driverDetails');
Route::get('get/details/appDriver/ByDate','UserController@driverDetailsByDate')->name('admin.driverDetailsByDate');


########################################== terms ==################################################

Route::group(['prefix'=>'app_setting_terms'],function(){
    Route::get('/','TermsController@index')->name('admin.AppSettingTerms');
    Route::post('update/{id}','TermsController@update')->name('admin.AppSettingTerms.update');
});
#######################################==app_setting_faq==##########################################
Route::group(['prefix'=>'app_setting_faq'],function(){
    Route::get('/','AppSettingFaqController@index')->name('admin.AppSettingFaq');
    Route::get('creat','AppSettingFaqController@creat')->name('admin.AppSettingFaq.creat');
    Route::post('store','AppSettingFaqController@store')->name('admin.AppSettingFaq.store');
    Route::get('edit/{id}','AppSettingFaqController@edit')->name('admin.AppSettingFaq.edit');
    Route::post('update/{id}','AppSettingFaqController@update')->name('admin.AppSettingFaq.update');
    Route::get('delete/{id}','AppSettingFaqController@destroy')->name('admin.AppSettingFaq.delete');
});


########################################== socialMedia ==################################################

Route::group(['prefix'=>'app_setting_social'],function(){
    Route::get('/','AdminSocialMediaController@index')->name('admin.AppSettingSocial');
    Route::post('update/{id}','AdminSocialMediaController@update')->name('admin.AppSettingSocial.update');
});

########################################== Support ==################################################

Route::group(['prefix'=>'app_setting_Support'],function(){
    Route::get('/','AdminSupportController@index')->name('admin.AppSettingSupport');
    Route::post('update/{id}','AdminSupportController@update')->name('admin.AppSettingSupport.update');
});


#######################################==sentServices==##########################################
Route::group(['prefix'=>'sentServices'],function(){
    Route::get('/','SentServicesController@index')->name('admin.SentServices');
    Route::get('creat','SentServicesController@creat')->name('admin.SentServices.creat');
    Route::post('store','SentServicesController@store')->name('admin.SentServices.store');
    Route::get('edit/{id}','SentServicesController@edit')->name('admin.SentServices.edit');
    Route::post('update/{id}','SentServicesController@update')->name('admin.SentServices.update');
    Route::get('delete/{id}','SentServicesController@destroy')->name('admin.SentServices.delete');
});

####################################==ContactMail==3###############################################
Route::group(['prefix'=>'ContactMail'],function(){

    Route::get('washSquad','ContactMailController@index')->name('admin.ContactMail');
    Route::post('store','ContactMailController@creat')->name('admin.ContactMail.creat');
    Route::post('store','ContactMailController@store')->name('admin.ContactMail.store');
    Route::get('delete/{id}','ContactMailController@destroy')->name('admin.ContactMail.delete');


});




#######################################==online_store_categories==##########################################
Route::group(['prefix'=>'online_store_categories'],function(){
    Route::get('/','OnlineStoreCategoriesController@index')->name('admin.OnlineStoreCategories');

    Route::get('creat','OnlineStoreCategoriesController@creat')->name('admin.OnlineStoreCategories.creat');
    Route::post('store','OnlineStoreCategoriesController@store')->name('admin.OnlineStoreCategories.store');
    Route::get('edit/{id}','OnlineStoreCategoriesController@edit')->name('admin.OnlineStoreCategories.edit');
    Route::post('update/{id}','OnlineStoreCategoriesController@update')->name('admin.OnlineStoreCategories.update');
    Route::get('delete/{id}','OnlineStoreCategoriesController@destroy')->name('admin.OnlineStoreCategories.delete');
});


#######################################==UserEmploy==##########################################
Route::group(['prefix'=>'UserEmploy'],function(){
    Route::get('/','UserEmployController@index')->name('admin.UserEmploy');

    Route::post('store','UserEmployController@store')->name('admin.UserEmploy.store');
    Route::get('edit/{id}','UserEmployController@edit')->name('admin.UserEmploy.edit');
    Route::post('update/{id}','UserEmployController@update')->name('admin.UserEmploy.update');
    Route::get('delete/{id}','UserEmployController@destroy')->name('admin.UserEmploy.delete');
    Route::get('pdf','UserEmployController@pdf')->name('admin.UserEmploy.pdf');
});




#######################################== SalariesCommissions ==##########################################
Route::group(['prefix'=>'SalariesCommissions'],function(){
    Route::get('/','SalaryAndCommissionController@index')->name('admin.SalariesCommissions');

    Route::post('store','SalaryAndCommissionController@store')->name('admin.SalariesCommissions.store');
    Route::post('edit/{id}','SalaryAndCommissionController@edit')->name('admin.SalariesCommissions.edit');
    Route::get('update','SalaryAndCommissionController@update')->name('admin.SalariesCommissions.update');
    Route::get('delete/{id}','SalaryAndCommissionController@destroy')->name('admin.SalariesCommissions.delete');

    Route::get('get/searchBYName/{search}','SalaryAndCommissionController@search')->name('admin.SalariesCommissions.search');
    Route::get('excel','SalaryAndCommissionController@export')->name('admin.SalariesCommissions.excel');
});

#######################################==apps==##########################################
Route::group(['prefix'=>'apps'],function(){
    Route::get('/','AppsController@index')->name('admin.Apps');
    Route::get('creat','AppsController@creat')->name('admin.Apps.creat');
    Route::post('store','AppsController@store')->name('admin.Apps.store');
    Route::get('edit/{id}','AppsController@edit')->name('admin.Apps.edit');
    Route::post('update/{id}','AppsController@update')->name('admin.Apps.update');
    Route::get('delete/{id}','AppsController@destroy')->name('admin.Apps.delete');
    Route::get('excel','AppsController@export')->name('admin.Apps.excel');

});

#######################################==FinancialOrderReports==##########################################
Route::group(['prefix'=>'FinancialOrderReports'],function(){
    Route::get('/','FinancialOrderReportsController@index')->name('admin.FinancialOrderReports');

    Route::get('excel','FinancialOrderReportsController@export')->name('admin.FinancialOrderReports.excel');
    Route::get('excel','FinancialOrderReportsController@export')->name('admin.FinancialOrderReports.excel');

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
Route::get('show/couponDetails','CouponController@couponDetails')->name('admin.couponDetails');

Route::get('show/couponDetailsByDate','CouponController@couponDetailsByDate')->name('admin.couponDetailsByDate');


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

Route::get('add/invoice/car/revenue','RevenueController@addinvoice')->name('admin.revenue.add.invoice');

Route::get('get/order/for/car/revenue','RevenueController@getOrderById')->name('admin.car.revenue.getOrderById');

Route::get('add/instant/reward','RevenueController@addInstantReward')->name('admin.addInstantReward');

Route::get('edit/revenue/order/balance','RevenueController@editRevenueBalance')->name('admin.editRevenueBalance');

Route::get('update/order/car/revenue','RevenueController@editOrderCarRevenue')->name('admin.editOrderCarRevenue');


/////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('get/daysForParticipation','ParticipationController@getDays')->name('admin.participation.day');

Route::get('add/participation','ParticipationController@addParticipation')->name('admin.add.participation');

Route::get('get/orderdetails','ParticipationController@getOrderDeatails')->name('admin.order.participation.details');


Route::get('get/participation/filter/ByDate','ParticipationController@participationByDate')->name('admin.participation.filterByDate');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////   Setting    //////////////////////////////////////////////////////////////


Route::get('get/setting','SettingController@index')->name('admin.setting');

Route::get('change/admin/status','SettingController@changeAdminStatus')->name('admin.status.change');


Route::get('admin/delete','SettingController@deleteAdmin')->name('admin.delete.admin');


Route::get('create/admin','SettingController@createAdmin')->name('admin.create.admin');

Route::post('add/admin','SettingController@addAdmin')->name('admin.add.admin');



Route::get('edit/admin/{id}','SettingController@editAdmin')->name('admin.edit.admin');

Route::post('update/admin/{id}','SettingController@updateAdmin')->name('admin.update.admin');

/////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////  El sdodey تقارير الطلبات //////////////////////////////////////////////


Route::get('get/financel/order/report','FinancelOrderController@getOrderReport')->name('admin.get.order.report');

Route::get('financialOrderReport/searchByDate/{date}','FinancelOrderController@searchByDate')->name('admin.financialOrderReport.searchByDate');

Route::get('financialOrderReport/searchByOrderStatus/{orderStatus}','FinancelOrderController@searchByOrderStatus')->name('admin.financialOrderReport.searchByOrderStatus');


///////////////////////////////////////////////







/////////////////////////////////////////////////////////////////////////////////////////////////////////
