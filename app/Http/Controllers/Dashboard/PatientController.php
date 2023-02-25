<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor|secr']);
    }
    public function index()
    {

        $users=User::whereRole(['user'])
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('appointments')
            ->paginate(5);
        return view('dashboard.patients.index',compact('users'));
    }

    public function show($id)
    {
        $user=User::findOrFail($id)->with('appointments');
        return redirect()->route('dashboard.appointments.index', ['id'=>$id]);
    }
}
