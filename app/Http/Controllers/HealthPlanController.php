<?php

namespace App\Http\Controllers;

use App\Models\HealthPlan;
use App\Http\Requests\StoreHealthPlanRequest;
use App\Http\Requests\UpdateHealthPlanRequest;
use Illuminate\Http\Request;

class HealthPlanController extends Controller
{
    public function index()
    {
        $healthplans = HealthPlan::all();
        $healthplans = HealthPlan::paginate(10);
        
        return view('admin.healthplan', compact('healthplans'));
    }

    public function store(Request $request)
    {
        $healthplan = new HealthPlan;
        $healthplan->name = $request->name;
        $healthplan->desc = $request->desc;
        $healthplan->discount = $request->discount;
        $healthplan->save();

        return redirect()->back();
    }
    public function edit(Request $request, HealthPlan $healthplan)
    {
        $healthplan->name = $request->name;
        $healthplan->desc = $request->desc;
        $healthplan->discount = $request->discount;
        $healthplan->save();
    }
    public function destroy(HealthPlan $healthplan)
    {
        $healthplan->users($healthplan->id)->each(function($user){
            $user->healthp_id = 1;
            $user->save();
        });
        $healthplan->delete();
        return redirect()->back();
    }
}
