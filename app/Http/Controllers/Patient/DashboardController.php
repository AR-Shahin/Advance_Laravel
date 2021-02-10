<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(){
        if(View::exists('patient.dashboard')){
            return view('patient.dashboard');
        }else{
            abort(404);
        }
    }
}
