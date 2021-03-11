<?php

namespace App\Http\Controllers\Patient\Auth;

use function abort;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientPasswordRequest;
use App\Http\Requests\PatientPasswordResetRequest;
use App\Mail\PatientResetPassMail;
use App\Models\Patient;
use function back;
use function bcrypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use function uniqid;

class ForgotPasswordController extends Controller
{
    public function index(){
        if(View::exists('patient.auth.forgot-password')){
            return \view('patient.auth.forgot-password');
        }
        abort(404);
    }
    public function resetPasswordView($token){
       // return $token;
        if(View::exists('patient.auth.reset-password')){
            return \view('patient.auth.reset-password',['token' => $token]);
        }
        abort(404);
    }

    public function sentResetPassToken(PatientPasswordRequest $request){
        $patient =  Patient::whereEmail($request->input('email'))->first();
        $patient->reset_pass_token = md5($request->input('email')) . uniqid();
       if($patient->save()){
           Mail::to($request->input('email'))->send(new PatientResetPassMail($patient));
           return back()->with('message','We sent a mail ! please check your mail!!');
       }
    }

    public function updateResetPassword(PatientPasswordResetRequest $request){
        $patient =  Patient::where('reset_pass_token',$request->input('token'))->first();
        if(!$patient){
            return redirect()
                ->action([LoginController::class, 'showLoginForm'])
                ->with('message', 'Something is wrong :)');
        }
        $patient->password = $request->input('password');
        $patient->reset_pass_token = null;
        if($patient->save()){
            return redirect()
                ->action([LoginController::class,'showLoginForm'])
                ->with('message','Password has updated! please login');
        }

    }
}
