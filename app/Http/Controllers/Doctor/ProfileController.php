<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use function redirect;

class ProfileController extends Controller
{
    public function showUpdateProfileForm(){
        if(View::exists('doctor.profile.profile')){
            return \view('doctor.profile.profile',[
                'doctor' => Doctor::findOrfail(Auth::guard('doctor')->id()),
                'countries' => Country::select('id','name')->latest()->get()
            ]);
        }
    }
    public function updateProfile(Request $request){
        $id = Auth::guard('doctor')->id();

        $update = Doctor::find($id)->update(
            $request->except([
                '_token','_method','start_date','end_date','clinic_name','is_experience'
            ])
        );
        if ($update){
            return redirect()->back();
        }else{
            return $request->all();
        }

    }
}
