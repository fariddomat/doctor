<?php

namespace App\Http\Controllers\Dashboard;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;

class DoctorController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        if (Auth::user()->hasRole('doctor')) {
            if (Auth::id() != $id) {
                abort(403);
            }
        }
        $user = User::findOrFail($id);
        $doctor = Doctor::where('user_id', $id)->first();
        return view('dashboard.doctors.edit', compact('user', 'doctor'));
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
        $doctor = Doctor::where('user_id', $id)->firstOrFail();
        $request->validate([
            'spec' => 'required',
            'qout' => 'required',
            'img' => 'sometimes|image',
        ]);

        $request_data = $request->except(['img']);

        if ($request->img) {
            if ($doctor->img != null)
                Storage::disk('local')->delete('public/images/' . $doctor->img);

            $img = Image::make($request->img)
                ->resize(600, 600)
                ->encode('jpg');

            Storage::disk('local')->put('public/images/' . $request->img->hashName(), (string)$img, 'public');
            $request_data['img'] = $request->img->hashName();
        }


        $doctor->update($request_data);

        session()->flash('success', 'Successfully Updated !');
        if (Auth::user()->hasRole('doctor')) {
            return redirect()->back();
        }
        return redirect()->route('dashboard.users.index');
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
