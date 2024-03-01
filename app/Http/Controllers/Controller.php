<?php

namespace App\Http\Controllers;

use App\Models\Surgery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{

    public function appointment()
    {
        if(Auth::guard('doctor')->check()){
            $doctor = Auth::guard('doctor')->user();
            $surgeries = Surgery::where('doctor_id', $doctor->id)->paginate(10);
            
            return view('doctor.surgery', compact('surgeries'));
        }elseif(Auth::guard('web')->check()){
            return view('patient.surgery');
        }else{
            return redirect('/login');
        }
    }
}   
