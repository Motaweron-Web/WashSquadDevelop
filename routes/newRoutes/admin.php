<?php
use Illuminate\Support\Facades\Route;

////////////////////////  الأوقات المتاحه //////////////////////
Route::resource('available-times', 'AvailableTimesController');

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
