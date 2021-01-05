<?php

use Illuminate\Support\Facades\Route;

Route::get('test',function (){
return view('doctor.dashboard');
});

Route::name('doctor.')->namespace('Doctor')->prefix('doctor')->group(function (){

    //Auth Routes
    Route::namespace('Auth')->middleware('guest')->group(function (){
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::get('register','RegistrationController@showRegistrationForm')->name('register');
    });
});

