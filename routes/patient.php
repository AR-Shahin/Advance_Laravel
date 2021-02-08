<?php


use Illuminate\Support\Facades\Route;

Route::namespace('Patient')->name('patient.')->prefix('patient')->group(function (){

    //Guest Routes
    Route::namespace('Auth')->group(function (){
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::get('register','RegistrationController@showRegistrationForm')->name('register');
        Route::post('register','RegistrationController@registrationProcess')->name('register');
        Route::get('verify/{token}','RegistrationController@verifyDoctorAccount')->name('verify');
        Route::post('login','LoginController@loginProcess')->name('login');
    });

});