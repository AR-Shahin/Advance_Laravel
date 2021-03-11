<?php

namespace App\Http\Controllers\Patient\Auth;

use function abort;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ForgotPasswordController extends Controller
{
    public function index(){
        if(View::exists('patient.auth.forgot-password')){
            return \view('patient.auth.forgot-password');
        }
        abort(404);
    }
    public function resetPasswordView(){
        if(View::exists('patient.auth.reset-password')){
            return \view('patient.auth.reset-password');
        }
        abort(404);
    }
}
