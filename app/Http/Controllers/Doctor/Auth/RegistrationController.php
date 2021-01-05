<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RegistrationController extends Controller
{
    public function showRegistrationForm(){
        if(View::exists('doctor.auth.register')){
            return view('doctor.auth.register');
        }
        abort(404);
    }
}
