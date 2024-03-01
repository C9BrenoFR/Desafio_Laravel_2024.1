<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HealthPlan;
use App\Models\Specialty;
use App\Models\Surgery;
use App\Http\Requests\StoreSurgeryRequest;
use App\Http\Requests\UpdateSurgeryRequest;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        
        $helthPlanid = $user->healthp_id;
        $helthPlan = new HealthPlan;
        $helthPlan = $helthPlan->findById($helthPlanid);

        $typeid = new Specialty;
        $typeid = $typeid->findById($request->type);
        $type = $typeid->name;

        $price =  $typeid->price - ($typeid->price * (($helthPlan->discount)/100));
        $price = number_format($price, 2, ',', '.');

        $dateStart = new DateTime($request->date);
        $dateEnd = clone $dateStart;
        $dateEnd->add(new DateInterval('PT2H'));

        $doctorId = new Doctor;
        $doctorId = $doctorId->findById($request->doctor);
        $surgeries = $doctorId->surgeries()->get();
        $doctor = $doctorId->name;
        
        
        //verificações
    
        $turnStart = null;
        $turnEnd = null;

        $hourStart = $dateStart->format('H:i:s');
        $hourEnd = $dateEnd->format('H:i:s');

        switch ($doctorId->period) {
            case '00h-06h':
                $turnStart = '00:00:00';
                $turnEnd = '06:00:00';
                break;

            case '06h-12h':
                $turnStart = '06:00:00';
                $turnEnd = '12:00:00';
                break;

            case '12h-18h':
                $turnStart = '12:00:00';
                $turnEnd = '18:00:00';
                break;

            case '18h-00h':
                $turnStart = '18:00:00';
                $turnEnd = '23:59:59';
                break;

            default:
                break;
        }

        if($hourStart < $turnStart || $hourStart > $turnEnd){
            return redirect()->back()
            ->with('mensagem', "O(a) Doutor(a) $doctor não atende nesse horário");
        }

        foreach ($surgeries as $surgery) {  
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $surgery->date_start);
            $diff = $dateStart->diff($date);
            $totalHours = $diff->days * 24 + $diff->h;
            
            if($totalHours <= 2){
                return redirect()->back()
                ->with('mensagem', "O(a) Doutor(a) $doctor já possui uma cirurgia marcada para esse horário");
            }
        }

        return view('patient.confirm', compact('type', 'doctor', 'dateStart', 'dateEnd', 'price'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doctor = new Doctor;
        $doctor = $doctor->finfByName($request->doctor);

        $datestart = DateTime::createFromFormat('d/m/Y H:i', $request->dateS);
        $dateend = DateTime::createFromFormat('d/m/Y H:i', $request->dateE);


        $surgery = new Surgery;
        $surgery->type = $request->type;
        $surgery->doctor_id = $doctor->id;
        $surgery->patient_id = $request->user()->id;
        $surgery->date_start = $datestart;
        $surgery->date_end = $dateend;
        $surgery->price = $request->price;
        $surgery->save();

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Surgery $surgery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surgery $surgery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurgeryRequest $request, Surgery $surgery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $surgery = new Surgery;
        $surgery = $surgery->findById($request->id);

        if(!$request->user()->can('delete', $surgery)){
            abort(403);
        }

        $date = DateTime::createFromFormat('d/m/Y H:i', $request->date);
        $now = new DateTime();
        $diff = $date->diff($now);
        $totalHours = $diff->days * 24 + $diff->h;

        if($date < $now){
            return redirect('/dashboard')->with('mensagem', " A cirurgia ja aconteceu, não é possivel cancelar.");
        }elseif($totalHours <= 72){
            return redirect('/dashboard')->with('mensagem', "Não é possível cancelar a cirurgia com menos de 72 horas de antecedência");
        }


        $surgery->delete();

        return redirect('/dashboard')->with('mensagem', "Cirurgia cancelada com sucesso");
    }
}
