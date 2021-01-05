<?php

namespace App\Http\Controllers\Doctor;

use function abort;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(){
        if(View::exists('doctor.dashboard')){
            return view('doctor.dashboard');
        }else{
            abort(404);
        }
    }
}
