<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::all();
        $specialties = Specialty::paginate(10);
        
        return view('admin.specialty', compact('specialties'));
    }

    public function store(Request $request)
    {
        $specialty = new Specialty;
        $specialty->name = $request->name;
        $specialty->desc = $request->desc;
        $specialty->price = $request->price;
        $specialty->save();

        return redirect()->back();
    }
    public function edit(Request $request, int $id)
    {
        $specialty = new Specialty;
        $specialty = $specialty->findById($id);
        $specialty->name = $request->name;
        $specialty->desc = $request->desc;
        $specialty->price = $request->price;
        $specialty->save();
    }
    public function destroy(Specialty $specialty)
    {
        $specialty->doctors()->each(function($doctor){
            $doctor->surgeries()->each(function($surgery){
                $surgery->delete();
            });
            $doctor->delete();
        });
        $specialty->delete();
        return redirect()->back();
    }
}
