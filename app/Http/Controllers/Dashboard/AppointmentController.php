<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\DailyAppointment;
use App\DateOfWork;
use App\DayOfWork;
use App\Doctor;
use App\DoctorAppointment;
use App\Http\Controllers\Controller;
use App\Patient;
use App\SettingLog;
use App\Status;
use App\Treatment;
use App\Type;
use App\User;
use DateTime;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|doctor|secr']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('doctor')) {

            $appointments = Appointment::whenStatus($request->status)->whenUser(auth()->id())->with(['patient', 'type'])->latest()->withTrashed()->paginate(5);
        } elseif ($request->id) {

            $appointments = Appointment::whenStatus($request->status)->where('patient_id', $request->id)->with(['patient', 'type'])->latest()->withTrashed()->paginate(5);
        } else {

            $appointments = Appointment::whenStatus($request->status)->with(['patient', 'type'])->latest()->withTrashed()->paginate(5);
        }
        return view('dashboard.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereRole('user')->get();
        $doctors = User::whereRole('doctor')->get();
        $types = Type::all();
        return view('dashboard.appointments.create', compact('users', 'doctors', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'type_id' => 'required',
            'appointment_time' => 'required',
            'appointment_date' => 'required',
        ]);

        $date = $request->appointment_date;
        $d    = new DateTime($date);
        $d->format('l');  //pass l for lion aphabet in format

        $day = DayOfWork::where('day', $d->format('l'))->first();
        $time = DailyAppointment::findOrFail($request->appointment_time);
        // dd($time);
        if (auth()->user()->hasRole('doctor')) {
            $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        } else {
            $doctor = Doctor::where('user_id', $request->doctor_id)->firstOrFail();
        }

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

        $patient = Patient::where('user_id', $request->user_id)->firstOrFail();

        // dd(true);

        // dd($doctorAppointment->id);

        $appointment = Appointment::create([
            'doctor_appointment_id' => $doctorAppointment->id,
            'patient_id' => $patient->id,
            'type_id' => $request->type_id,
            'appointment_time' => $time->time,
            'appointment_date' => $request->appointment_date,
            'user_message' => $request->user_message,
        ]);

        Status::create([
            'appointment_id' => $appointment->id,
            'status' => 'Pending Appointment - by : ' . auth()->user()->name
        ]);
        SettingLog::log('success', auth()->id(), 'New Appointment - Patient name : ' . User::find($request->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Created Successfully !');
        return redirect()->route('dashboard.appointments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);

        return view('dashboard.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $users = User::whereRole('user')->get();
        $doctors = User::whereRole('doctor')->get();
        $types = Type::all();
        return view('dashboard.appointments.edit', compact('appointment', 'users', 'doctors', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'type_id' => 'required',
            'appointment_time' => 'required',
            'appointment_date' => 'required',
        ]);

        $appointment = Appointment::findOrFail($id);
        $date = $request->appointment_date;
        $d    = new DateTime($date);
        $d->format('l');  //pass l for lion aphabet in format

        $day = DayOfWork::where('day', $d->format('l'))->first();
        $time = DailyAppointment::findOrFail($request->appointment_time);
        $doctor = null;
        if (auth()->user()->hasRole('doctor')) {
            $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        } else {
            $doctor = Doctor::where('user_id', $request->doctor_id)->firstOrFail();
        }


        if (
            $doctor->id != $appointment->doctor_appointment->doctor_id
            || $time->time != $appointment->appointment_time || $request->appointment_date != $appointment->appointment_date
        ) {
            $d_a = DoctorAppointment::where('doctor_id', $doctor->id)->where('daily_appointment_id', $time->id)->count();
            if ($d_a > 0) {
                $a = Appointment::where('appointment_time', $time->time)->where('appointment_date', $request->appointment_date)->count();
                if ($a > 0) {
                    return redirect()->back()->withErrors([
                        'msg' => 'This appointment is already taken'
                    ]);
                }
            }
            Status::create([
                'appointment_id' => $appointment->id,
                'status' => 'Apologies for defering Appointment - by : ' . auth()->user()->name
            ]);
        }

        $doctorAppointment = DoctorAppointment::updateOrCreate([
            'id' => $appointment->doctor_appointment->id
        ], [
            'doctor_id' => $doctor->id,
            'daily_appointment_id' => $time->id,
        ]);

        $patient = Patient::where('user_id', $request->user_id)->firstOrFail();

        // dd(true);

        // dd($doctorAppointment->id);

        $appointment->update([
            'doctor_appointment_id' => $doctorAppointment->id,
            'patient_id' => $patient->id,
            'type_id' => $request->type_id,
            'appointment_time' => $time->time,
            'appointment_date' => $request->appointment_date,
            'user_message' => $request->user_message,
        ]);
        SettingLog::log('success', auth()->id(), 'New Appointment - Patient name : ' . User::find($request->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Created Successfully !');
        return redirect()->route('dashboard.appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctorAppointment = $appointment->doctor_appointment;
        $doctorAppointment->delete();
        $appointment->delete();
        Status::create([
            'appointment_id' => $appointment->id,
            'status' => 'Cancel Appointment - by : '.auth()->user()->name
        ]);
        SettingLog::log('danger', auth()->id(), 'Delete Appointment - Patient name : ' . User::find($appointment->patient->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Deleted Successfully !');
        return redirect()->route('dashboard.appointments.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $appointment = Appointment::findOrFail($request->id);
        $appointment->status = $request->status;
        $appointment->save();

        Status::create([
            'appointment_id' => $appointment->id,
            'status' => $appointment->status . ' Appointment - by : ' . auth()->user()->name
        ]);
        SettingLog::log('warning', auth()->id(), $request->status.' Appointment - Patient name : ' . User::find($appointment->patient->user_id)->name, route('dashboard.appointments.show', $appointment->id));

        session()->flash('success', 'Status updated Successfully !');
        return redirect()->back();
    }
}
