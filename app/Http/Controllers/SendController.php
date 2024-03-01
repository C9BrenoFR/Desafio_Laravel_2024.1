<?php

namespace App\Http\Controllers;

use App\Mail\Send;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendController extends Controller
{
    public function index()
    {
        return view('admin.send');
    } 

    public function store(Request $request)
    {
        $users = User::all();
        $subject = $request->subject;
        $message = $request->message;

        foreach($users as $user){
            Mail::to($user->email, $user->name)->send(new Send([
                'message' => $message, 
                'subject' => $subject, 
                'name' => $user->name,
            ]));
        }

        return redirect()->back();
    }
}
