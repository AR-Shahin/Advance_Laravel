<?php

use Illuminate\Support\Facades\Route;

Route::get('test',function (){
return view('doctor.dashboard');
});

Route::name('doctor.')->namespace('Doctor')->prefix('doctor')->group(function (){

    //Auth Routes
    Route::namespace('Auth')->middleware('guest:doctor')->group(function (){
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::get('register','RegistrationController@showRegistrationForm')->name('register');
        Route::post('register','RegistrationController@registrationProcess')->name('register');
        Route::post('login','LoginController@loginProcess')->name('login');
    });
    //Authencate Routes
    Route::middleware('auth:doctor')->group(function (){
        Route::post('logout','Auth\LoginController@logout')->name('logout');
        Route::get('dashboard','DashboardController@index')->name('dashboard');
    });


});

