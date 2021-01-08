<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm(){
        if(View::exists('doctor.auth.change-password')){
            return \view('doctor.auth.change-password');
        }
    }

    public function processChangePassword(Request $request){
        $prevoius_pass = Auth::guard('doctor')->user()->password;

        $doctor_id = Auth::guard('doctor')->id();

        if (Hash::check($request->oldPassword , $prevoius_pass )) {
            if (!Hash::check($request->newPassword , $prevoius_pass)) {
                Doctor::where('id' , $doctor_id)->update(
                    [
                        'password' =>  Hash::make($request->newPassword)
                    ]
                );
                $this->setSuccessMessage('Password updated successfully!');
                return redirect()->back();
            }
            else{
                $this->setErrorMessage('New password can not be the old password!');
                return redirect()->back();
            }
        }
        else{
            $this->setErrorMessage('Old password was wrong. sorry, try again!');
            return redirect()->back();
        }
    }
}
