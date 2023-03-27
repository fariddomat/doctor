<?php

namespace App\Http\Controllers\Dashboard;

use App\Ddetail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;

class DdetailController extends Controller
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
        $doctors = User::whereRole('doctor')->doesntHave('ddetail')->get();
        return view('dashboard.ddetails.create', compact('doctors'));
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
            'doctor_id' => 'required',
            'spec' => 'required',
            'qout' => 'required',
            // 'twitter' => 'required',
            // 'facebook' => 'required',
            // 'instagram' => 'required',
            // 'linkedIn' => 'required',
            // 'whatsapp' => 'required',
            'img' => 'required|image',
        ]);


        $request_data = $request->except(['img']);


        $img = Image::make($request->img)
            ->resize(600, 600)
            ->encode('jpg');

        Storage::disk('local')->put('public/images/' . $request->img->hashName(), (string)$img, 'public');
        $request_data['img'] = $request->img->hashName();


        $ddetail = Ddetail::create($request_data);

        session()->flash('success', 'Successfully Created !');
        return redirect()->route('dashboard.users.index');
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
        $doctor = User::findOrFail($id);
        $ddetail = Ddetail::where('doctor_id', $id)->first();
        return view('dashboard.ddetails.edit', compact('doctor', 'ddetail'));
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
        $ddetail = Ddetail::findOrFail($id);
        $request->validate([
            'spec' => 'required',
            'qout' => 'required',
            'img' => 'sometimes|image',
        ]);

        $request_data = $request->except(['img']);

        if ($request->img) {
            if ($ddetail->img != null)
                Storage::disk('local')->delete('public/images/' . $ddetail->img);

            $img = Image::make($request->img)
                ->resize(600, 600)
                ->encode('jpg');

            Storage::disk('local')->put('public/images/' . $request->img->hashName(), (string)$img, 'public');
            $request_data['img'] = $request->img->hashName();
        }


        $ddetail->update($request_data);

        session()->flash('success', 'Successfully Updated !');
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