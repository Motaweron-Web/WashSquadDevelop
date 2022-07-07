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
    Route::post('update','AppsController@update')->name('admin.Apps.update');
    Route::get('delete/{id}','AppsController@destroy')->name('admin.Apps.delete');
    Route::get('excel','AppsController@export')->name('admin.Apps.excel');

});

#######################################==FinancialOrderReports==##########################################
Route::group(['prefix'=>'FinancialOrderReports'],function(){
    Route::get('/','FinancialOrderReportsController@index')->name('admin.FinancialOrderReports');

    Route::get('excel','FinancialOrderReportsController@export')->name('admin.FinancialOrderReports.excel');
    Route::get('excel','FinancialOrderReportsController@export')->name('admin.FinancialOrderReports.excel');

});
