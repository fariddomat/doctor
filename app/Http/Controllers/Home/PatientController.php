<?php

namespace App\Http\Controllers\Home;

use App\Appointment;
use App\DateOfWork;
use App\Http\Controllers\Controller;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{

    public function appointment()
    {
            $types=Type::all();
            $doctors=User::whereRole('doctor')->get();
            $dayOfWorks=DateOfWork::all();
            // dd(json_encode(array_merge($dayOfWorks->pluck('dates')->toArray())));
            return view('home.appointment', compact('types', 'doctors', 'dayOfWorks'));

    }

    public function postAppointment(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'doctor_id'=>'required',
            'type_id'=>'required',
            'appointment_time'=>'required',
            'appointment_date'=>'required',
        ]);

        Appointment::create($request->all());
        session()->flash('success', 'Make appointment successfully');
        return redirect()->route('home');
    }

    public function profile()
    {
        $user=User::findOrFail(auth()->id());
        return view('home.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user=User::find(Auth::id());
        $request->validate([
            'name' => 'required',
            'email'=>'required|email|unique:users,email,' . Auth::id(),
        ]);
        if ($request->password != "") {

            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $request->merge(['password' => bcrypt($request->password)]);
            $user->update($request->all());
        }else{
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,

            ]);

        }
        session()->flash('success','Successfully Updated!');
        return redirect()->back();
    }
}
