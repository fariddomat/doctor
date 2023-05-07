<?php

namespace App\Http\Controllers\Home;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Type;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $patients=User::role('user')->count();
        $appointments=Appointment::count();
        $types=Type::count();
        $doctors=User::role('doctor')->get();
        return view('home.index', compact('patients', 'appointments', 'types', 'doctors'));
    }
}
