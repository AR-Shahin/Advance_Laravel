<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function showUpdateProfileForm(){
        if(View::exists('doctor.profile.profile')){
            return \view('doctor.profile.profile',[
                'doctor' => Doctor::findOrfail(Auth::guard('doctor')->id())
            ]);
        }
    }
    public function updateProfile(Request $request){
        return $request->all();
    }
}
