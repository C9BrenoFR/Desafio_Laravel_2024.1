<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        $doctors = Doctor::paginate(10); 
        $specialties = Specialty::all();

        return view('admin.doctor', compact('doctors', 'specialties'));
    }

   
    public function store(Request $request)
    {
        $doctor = new Doctor();

        if($request->hasFile('pfp'))
        {
        $file = $request->file('pfp');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $caminho = '/uploads/';
        $file->move($caminho, $filename);
        $doctor->pfp = $caminho.$filename;
        }else{
            $doctor->pfp = '/uploads/default.jpg';
        }
        

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->bdate = $request->bdate;
        $doctor->adress = $request->adress;
        $doctor->phone = $request->phone;
        $doctor->cpf = $request->cpf;
        $doctor->crm = $request->crm;
        $doctor->specialty_id = $request->specialty;
        $doctor->save();

        if (env('APP_ENV') !== 'testing') {
            return redirect()->back();
        }
    }

    public function update(Request $request, int $doctorid)
    {
        if(Auth::guard('doctor')->check()){
            $doctor = Auth::guard('doctor')->user();
        }else{
            $doctor = Doctor::find($doctorid);
        }

        if($request->hasFile('pfp')){
            $file = $request->file('pfp');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $caminho = '/uploads/';
            $file->move($caminho, $filename);
            $doctor->pfp = $caminho.$filename;
        }

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->bdate = $request->bdate;
        $doctor->adress = $request->adress;
        $doctor->phone = $request->phone;
        $doctor->cpf = $request->cpf;
        $doctor->crm = $request->crm;
        $doctor->period = $request->period;
        $doctor->specialty_id = $request->specialty_id;
        $doctor->save();

        if (env('APP_ENV') !== 'testing') {
            return redirect()->back();
        }
    }

  
    public function destroy(Doctor $doctor, int $doctorid)
    {
        if(Auth::guard('doctor')->check()){
            Auth::guard('doctor')->logout();
        }

        $doctor = Doctor::find($doctorid);
        $doctor->surgeries()->each(function($surgery){
            $surgery->delete();
        });
        $doctor->delete();

        if (env('APP_ENV') !== 'testing') {
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request, int $doctorid)
    {
        $doctor = Doctor::find($doctorid);

        if(Hash::check($request->current_password, $doctor->password)){
            $doctor->password = Hash::make($request->password);
            $doctor->save();
        }else{
            return redirect()->back()->withErrors(['current_password' => 'Senha atual incorreta']);
        }

        return redirect()->back();
    }

    public function medicalReport()
    {
        $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        $surgeries = $doctor->surgeries()->orderBy('date_start', 'asc')->get();
        
        $pdf = Pdf::loadView('doctor.medicalreport', compact('doctor', 'surgeries'));
        return $pdf->stream();
    }   

}
