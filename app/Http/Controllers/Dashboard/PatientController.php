<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Patient;
use App\SettingLog;
use App\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|doctor|secr']);
    }
    public function index()
    {

        $users=User::whereRole(['user'])
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('patient')
            ->paginate(5);
        return view('dashboard.patients.index',compact('users'));
    }

    public function show($id)
    {
        $user=User::findOrFail($id)->with('appointments');
        return redirect()->route('dashboard.appointments.index', ['id'=>$id]);
    }

    public function rank(Request $request,$id)
    {
        $patient=Patient::findOrFail($id);
        $request->validate([
            'rank' => 'required|numeric|min:1|max:5'
        ]);
        $patient->update($request->all());
        SettingLog::log('success', auth()->id(), 'Rank Patient - Patient name : ' . User::find($patient->user_id)->name, route('dashboard.patients.index', $patient->id));
        session()->flash('success', 'Rank Successfully !');

        return redirect()->back();
    }
}
