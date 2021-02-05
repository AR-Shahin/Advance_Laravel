<?php

use Illuminate\Support\Facades\Route;


Route::get('/','HomeController@index')->name('home');
Route::get('doctor/{slug}','HomeController@getDoctorDetails')->name('doctor.details');
