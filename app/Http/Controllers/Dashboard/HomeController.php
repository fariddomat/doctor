<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class HomeController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        return view('admin.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
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

            ]);

        }
        session()->flash('success','Successfully Updated!');
        return redirect()->back();
    }
}
