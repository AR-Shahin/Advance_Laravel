<?php

use App\Http\Controllers;
use App\Http\Controllers\CropController;
use App\Http\Controllers\DropZoneImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;


Route::get('/','HomeController@index')->name('home');
//view single doctor
Route::get('view-doctor/{slug}','HomeController@getDoctorDetails')->name('doctor.details');
//appoint a doctor
Route::post('appointment/{id}','AppointmentController@storeAppointment')->name('appointment')->middleware('auth:patient');
Route::post('feedback','FeedbackController@storeFeedback')->name('feedback');

Route::resource('products',ProductController::class)->except(['edit','destroy','update']);

//role and permissions routes
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');

//DropZone
Route::get('dropzone',[DropZoneImageController::class,'index']);
Route::post('dropzone', [DropZoneImageController::class, 'store'])->name('dropzone');
Route::post('delete', [DropZoneImageController::class, 'delete'])->name('dropzone.delete');

//Crop
Route::get('crop', [CropController::class, 'index']);
Route::post('crop', [CropController::class, 'store'])->name('crop.store');

