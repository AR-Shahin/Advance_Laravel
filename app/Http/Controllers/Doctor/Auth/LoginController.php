<?php

namespace App\Http\Controllers\Doctor\Auth;

use function abort;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{

    public function showLoginForm(){
        if(View::exists('doctor.auth.login')){
            return view('doctor.auth.login');
        }
        abort(404);
    }
}
