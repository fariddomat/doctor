<?php

namespace App\Http\Controllers\Home;

use App\Appointment;
use App\DailyAppointment;
use App\DayOfWork;
use App\Doctor;
use App\DoctorAppointment;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class PatientController extends Controller
{

    public function appointment()
    {
        $types = Type::all();
        $doctors = User::whereRole('doctor')->get();
        // dd(json_encode(array_merge($dayOfWorks->pluck('dates')->toArray())));
        return view('home.appointment', compact('types', 'doctors'));
    }

    public function appointmentTime(Request $request)
    {


        try {
            $date = $request->appointment_date;
        $d    = new DateTime($date);
        $d->format('l');  //pass l for lion aphabet in format
        // dd($d->format('l'));
        $day = DayOfWork::where('day', $d->format('l'))->first();
        // dd($day);
        $time = DailyAppointment::where('day_of_work_id', $day->id)->get();
        return response()->json([
            'time' => $time
        ]);
        } catch (\Throwable $th) {
            return response()->json([
                'time' => null
            ]);
        }
    }

    public function postAppointment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'doctor_id' => 'required',
            'type_id' => 'required',
            'appointment_time' => 'required',
            'appointment_date' => 'required',
        ]);

        $date = $request->appointment_date;
        $d    = new DateTime($date);
        $d->format('l');  //pass l for lion aphabet in format
        // dd($d->format('l'));
        $day = DayOfWork::where('day', $d->format('l'))->first();
        $time = DailyAppointment::findOrFail($request->appointment_time);
        $doctor = Doctor::where('user_id', $request->doctor_id)->firstOrFail();
        $d_a = DoctorAppointment::where('doctor_id', $doctor->id)->where('daily_appointment_id', $time->id)->count();
        if ($d_a > 0) {
            $a = Appointment::where('appointment_time', $time->time)->where('appointment_date', $request->appointment_date)->count();
            if ($a > 0) {
                return redirect()->back()->withErrors([
                    'msg' => 'This appointment is already taken'
                ]);
            }
        }
        $doctorAppointment = DoctorAppointment::create([
            'doctor_id' => $doctor->id,
            'daily_appointment_id' => $time->id,
        ]);

        Appointment::create([
            'doctor_appointment_id' => $doctorAppointment->id,
            'patient_id' => auth()->user()->patient->id,
            'type_id' => $request->type_id,
            'appointment_time' => $time->time,
            'appointment_date' => $request->appointment_date,
            'user_message' => $request->user_message,
        ]);
        session()->flash('success', 'Make appointment successfully');
        return redirect()->route('home');
    }

    public function profile()
    {
        $user = User::findOrFail(auth()->id());
        // dd($user->id);
        return view('home.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
        if ($request->password != "") {

            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $request->merge(['password' => bcrypt($request->password)]);
            $user->update($request->all());
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,

            ]);
        }
        session()->flash('success', 'Successfully Updated!');
        return redirect()->back();
    }
}
