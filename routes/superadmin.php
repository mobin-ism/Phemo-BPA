<?php

Route::get('/companies', 'SCompanyController@index')->name('scompanies.index');
Route::get('/companies/details/{id}', 'SCompanyController@show')->name('scompanies.show');
Route::post('companies/users/list', 'SCompanyController@users')->name('scompanies.users');
Route::get('/companies/user/edit/credential/{id}', 'SCompanyController@credentials')->name('scompanies.credentials');
Route::post('/companies/user/update/credential', 'SCompanyController@update_credentials')->name('scompanies.update_credentials');
Route::get('/companies/user/delete/{id}', 'SCompanyController@delete_user')->name('scompanies.delete_user');
Route::get('/companies/account/activity/{id}', 'SCompanyController@activity')->name('scompanies.activity');
Route::get('/companies/account/payments/{id}', 'SCompanyController@payments')->name('scompanies.payments');
Route::get('/companies/account/summary/{id}', 'SCompanyController@summary')->name('scompanies.summary');