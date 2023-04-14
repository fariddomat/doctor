<?php

namespace App\Http\Controllers\Dashboard;

use App\DailyAppointment;
use App\DayOfWork;
use App\Http\Controllers\Controller;
use App\SettingLog;
use App\User;
use Illuminate\Http\Request;

class DailyAppointmentController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dayOfWork=DayOfWork::findOrFail($request->id);
        $dailyAppointment=DailyAppointment::where('day_of_work_id', $dayOfWork->id)->get();
        return view('dashboard.dailyAppointments.create', compact('dayOfWork', 'dailyAppointment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dayOfWork=DayOfWork::findOrFail($request->id);
        $request->validate([
            'id'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        // dd(date('g:i',strtotime($request->from)));
        for ($i=strtotime($request->from); $i <= strtotime($request->to);  $i+=1800 ) {
            DailyAppointment::create([
                'day_of_work_id'=> $request->id,
                'time'=> date('g:i', $i),
            ]);
        }

        SettingLog::log('success', auth()->id(), 'Add New Daily Appointment', route('dashboard.dailyAppointments.edit', $dayOfWork->id));

        session()->flash('success', 'Created Successfully !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dailyAppointment=DailyAppointment::findOrFail($id);
        $dailyAppointment->delete();

        SettingLog::log('danger', auth()->id(), 'Delete Day Of Work Start : '.$dailyAppointment->start.' - End : '.$dailyAppointment->end,null);
        session()->flash('success', 'Deleted Successfully !');
        return redirect()->back();
    }
}
