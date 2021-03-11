<?php


use Illuminate\Support\Facades\Route;
Route::get('test-patient',function (){
//    return view('mails.patient_verification');
});

Route::namespace('Patient')->name('patient.')->prefix('patient')->group(function (){

    //Guest Routes
    Route::namespace('Auth')->middleware('guest:patient')->group(function (){
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::get('register','RegistrationController@showRegistrationForm')->name('register');
        Route::post('register','RegistrationController@registrationProcess')->name('register');
        Route::get('verify/{token}','RegistrationController@verifyPatientAccount')->name('verify');
        Route::post('login','LoginController@loginProcess')->name('login');
        #Forgot password
        Route::get('forgot-password','ForgotPasswordController@index')->name('forgot-password');
        Route::get('reset-password','ForgotPasswordController@resetPasswordView')->name('reset-password');
    });

    //Auth Routes
    Route::middleware('auth:patient')->group(function (){
        #Auth Folder
        Route::namespace('Auth')->group(function (){
            Route::post('logout','LoginController@logout')->name('logout');
            Route::get('change-password','ChangePasswordController@showChangePasswordForm')->name('change-password');
            Route::patch('change-password','ChangePasswordController@processChangePassword')->name('change-password');
        });
        #Outside of folder
        Route::get('dashboard','DashboardController@index')->name('dashboard');

    });

});