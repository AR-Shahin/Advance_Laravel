<?php

use App\Models\Doctor;
use Illuminate\Support\Facades\Route;


Route::get('/','HomeController@index')->name('home');
Route::get('view-doctor/{slug}','HomeController@getDoctorDetails')->name('doctor.details');
