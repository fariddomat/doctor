<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\DateOfWork;
use App\Http\Controllers\Controller;
use App\SettingLog;
use App\Treatment;
use App\Type;
use App\User;
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
    public function index()
    {
        $appointments = Appointment::whenUser(request()->id)->with(['patient', 'type'])->paginate(5);
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
        $types = Type::all();
        $datesOfWork = DateOfWork::all();
        return view('dashboard.appointments.create', compact('users', 'types', 'datesOfWork'));
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
        $appointment = Appointment::create($request->all());
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
        $types = Type::all();
        $datesOfWork = DateOfWork::all();
        return view('dashboard.appointments.edit', compact('appointment', 'users', 'types', 'datesOfWork'));
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
        // $appointment = Appointment::findOrFail($id);
        // if (!$request->docotr_report) {
        //     $request->validate([
        //         'user_id' => 'required',
        //         'type_id' => 'required',
        //         'appointment_time' => 'required',
        //         'appointment_date' => 'required',
        //     ]);

        //     SettingLog::log('warning', auth()->id(), 'Update Appointment - Patient name : ' . User::find($request->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        // } else {
        //     $request->validate([
        //         'docotr_report' => 'required',
        //         'price' => 'required',
        //     ]);

        //     SettingLog::log('primary', auth()->id(), 'Doctor Add Report - Patient name : ' . User::find($appointment->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        // }
        // $appointment->update($request->all());

        // session()->flash('success', 'Updated Successfully !');
        // return redirect()->route('dashboard.appointments.index');
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
        $appointment->delete();

        SettingLog::log('danger', auth()->id(), 'Delete Appointment - Patient name : ' . User::find($appointment->patient->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Deleted Successfully !');
        return redirect()->route('dashboard.appointments.index');
    }
}
