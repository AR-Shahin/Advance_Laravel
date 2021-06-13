<?php

use App\Models\Doctor;
use App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoadMoreDataController;
use App\Http\Controllers\DropZoneImageController;
use App\Http\Controllers\ScrollInfiniteController;

Route::get('component', function () {

    return view('welcome', [
        'data' => [10, 20, 30, 40],
        'name' => 'Shahin,',
    ]);
});
Route::get('/', 'HomeController@index')->name('home');
//view single doctor
Route::get('view-doctor/{slug}', 'HomeController@getDoctorDetails')->name('doctor.details');
//appoint a doctor
Route::post('appointment/{id}', 'AppointmentController@storeAppointment')->name('appointment')->middleware('auth:patient');
Route::post('feedback', 'FeedbackController@storeFeedback')->name('feedback');

Route::resource('products', ProductController::class)->except(['edit', 'destroy', 'update']);

//role and permissions routes
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');

//DropZone
Route::get('dropzone', [DropZoneImageController::class, 'index']);
Route::post('dropzone', [DropZoneImageController::class, 'store'])->name('dropzone');
Route::post('delete', [DropZoneImageController::class, 'delete'])->name('dropzone.delete');

//Crop
Route::get('crop', [CropController::class, 'index']);
Route::post('crop', [CropController::class, 'store'])->name('crop.store');

//Load More Data

Route::get('load-data', [LoadMoreDataController::class, 'index']);
Route::post('load-data', [LoadMoreDataController::class, 'loadMoreData'])->name('load-data');


//Infinite Scroll
Route::get('load-infinite', [ScrollInfiniteController::class, 'index'])->name('load-infinite');

//Macro
Route::get('macro', function () {
    //return Arr::multiplyWithN([10, 20, 30], 2);
    return Arr::test(5);
});
