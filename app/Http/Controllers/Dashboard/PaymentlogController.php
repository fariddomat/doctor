<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Paymentlog;
use App\SettingLog;
use App\User;
use Illuminate\Http\Request;

class PaymentlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentlogs=Paymentlog::latest()->paginate(5);
        return view('dashboard.paymentlogs.index', compact('paymentlogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
        return view('dashboard.paymentlogs.create', compact('appointment'));
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
            'amount' => 'required'
        ]);
        $appointment = Appointment::findOrFail($request->id);
        $amount = 0;
        if ($request->amount) {
            $amount = $request->amount;
        }
        $unpaid = $appointment->treatment->unpaid_amount - $amount;
        if ($unpaid < 0) {
            return redirect()->back()->withErrors(['msg' => 'you give more than number']);
        }
        $paid = 0;
        if ($unpaid == 0) {
            $paid = 1;
        }

        if ($amount > 0) {
            $appointment->treatment->update([
                'unpaid_amount' => $unpaid,
                'paid' => $paid,
            ]);
            $paymentlog = Paymentlog::create([
                'treatment_id' => $appointment->treatment->id,
                'amount' => $amount,
            ]);
        }

        SettingLog::log('primary', auth()->id(), ' Add Payment - Patient name : ' . User::find($appointment->patient->user_id)->name, route('dashboard.appointments.show', $appointment->id));
        session()->flash('success', 'Updated Successfully !');
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
