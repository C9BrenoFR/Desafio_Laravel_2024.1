<?php

namespace App\Http\Controllers;

use App\Models\HealthPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $patients = User::all();
        $patients = User::paginate(10);
        $healthplans = HealthPlan::all();

        return view('admin.patient', compact('patients', 'healthplans'));
    }

    public function completeregister(Request $request)
    {
        $user = Auth::user();

        if($request->hasFile('pfp')){
            $file = $request->file('pfp');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $caminho = '/uploads/';
            $file->move($caminho, $filename);
            $user->pfp = $caminho.$filename;
        }

        $user->adress = $request->adress;
        $user->phone = $request->phone;
        $user->cpf = $request->cpf;
        $user->abo = $request->abo;
        $user->healthp_id = $request->healthp_id;
        $user->fst_login = 1;
        $user->save();

        return redirect('/dashboard');
    }

    public function update(Request $request, int $patient)
    {
        if(Auth::guard('web')->check()){
            $user = Auth::user();
        }else{
            $user = User::find($patient);
        }

        if($request->hasFile('pfp')){
            $file = $request->file('pfp');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = '/uploads/';
            $file->move($path, $filename);
            $user->pfp = $path.$filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bdate = $request->bdate;
        $user->adress = $request->adress;
        $user->phone = $request->phone;
        $user->cpf = $request->cpf;
        $user->abo = $request->abo;
        $user->healthp_id = $request->healthp_id;
        $user->save();

        return redirect()->back();
    }

    public function destroy(Request $request,int $patient)
    {
        $user = User::find($patient);
    
        $user->apointments($user->id)->each(function($surgery){
            $surgery->delete();
        });
        $user->delete();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bdate = $request->bdate;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back();
    }


    public function passwordupdate(Request $request, int $patient)
    {
        $user = User::find($patient);

        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
        }else{
            return redirect()->back()->withErrors(['current_password' => 'Senha atual incorreta']);
        }

        return redirect()->back();
    }
}
