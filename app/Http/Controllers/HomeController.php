<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function appointment()
    {
        if (auth()) {
            $types=Type::all();
            return view('home.appointment', compact('types'));
        }else{
            return redirect()->route('login');
        }
    }

    public function postAppointment(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'type_id'=>'required',
            'appointment_time'=>'required',
            'appointment_date'=>'required',
        ]);

        Appointment::create($request->all());
        session()->flash('success', 'Make appointment successfully');
        return redirect()->route('home');
    }
}
