<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Paymentlog;
use App\SettingLog;
use App\Treatment;
use App\User;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment=Appointment::findOrFail($request->appointment_id);
        $request->validate([
            'report' => 'required',
            'fee' => 'required',
        ]);
        $amount=0;
        if($request->amount){
            $amount=$request->amount;
        }
        $unpaid=$request->fee - $amount;
        $paid=0;
        if($unpaid==0){
            $paid=1;
        }
        $treatment=Treatment::create([
            'appointment_id'=>$request->appointment_id,
            'report'=> $request->report,
            'fee'=> $request->fee,
            'unpaid_amount'=> $unpaid,
            'note'=> $request->note,
            'paid'=> $paid,
        ]);
        if ($amount > 0) {
            $paymentlog=Paymentlog::create([
                'treatment_id'=> $treatment->id,
                'amount'=>$amount,
            ]);
        }

        SettingLog::log('primary', auth()->id(), 'Doctor Add Report - Patient name : ' . User::find($appointment->patient->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Updated Successfully !');
        return redirect()->route('dashboard.treatments.index');

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
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
