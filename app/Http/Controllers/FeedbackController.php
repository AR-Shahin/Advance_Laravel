<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use const false;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use const true;

class FeedbackController extends Controller
{
    public function storeFeedback(Request $request){
        if($this->checkPatientLogin()){
            if($this->checkPreviousFeedback()){
                $create = Feedback::create([
                    'doctor_id' => $request->doctor_id,
                    'patient_id' => Auth::guard('patient')->id(),
                    'ratting' => $request->ratting,
                    'comment' => $request->comment,
                ]);
                if($create){
                    return 'INSERT_FEEDBACK';
                }else{
                    return 'NOT_INSERT';
                }
            }else{
                return 'ALREADY_GIVEN';
            }
        }else{
            return 'NOT_LOGIN';
        }
    }

    protected function checkPatientLogin() :bool {
        if(Auth::guard('patient')->id()){
            return true;
        }else{
            return false;
        }
    }

    private function checkPreviousFeedback() :bool {
        $feedback = Feedback::where('patient_id',Auth::guard('patient')->id())->first();
        if($feedback){
            return false;
        }else{
            return true;
        }
    }
}
