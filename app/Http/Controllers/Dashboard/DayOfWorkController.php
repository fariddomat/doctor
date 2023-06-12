<?php

namespace App\Http\Controllers\Dashboard;

use App\DayOfWork;
use App\Http\Controllers\Controller;
use App\SettingLog;
use App\User;
use Illuminate\Http\Request;

class DayOfWorkController extends Controller
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
        $dayOfWorks=DayOfWork::all();
        return view('dashboard.dayOfWorks.index', compact('dayOfWorks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.dayOfWorks.create');
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
            'day'=>'required'
        ]);
        $dayOfWork=DayOfWork::create($request->all());
        SettingLog::log('success', auth()->id(), 'Add New Day Of Work', route('dashboard.dayOfWorks.edit', $dayOfWork->id));

        session()->flash('success', 'Created Successfully !');
        return redirect()->route('dashboard.dayOfWorks.index');
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
        $dayOfWork=DayOfWork::findOrFail($id);
        return view('dashboard.dayOfWorks.edit', compact('dayOfWork'));
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
        $request->validate([
            'day'=>'required',
        ]);
        $dayOfWork=DayOfWork::findOrFail($id);
        $dayOfWork->update($request->all());

        SettingLog::log('warning', auth()->id(), 'Update Day Of Work', route('dashboard.dayOfWorks.edit', $dayOfWork->id));
        session()->flash('success', 'Updated Successfully !');
        return redirect()->route('dashboard.dayOfWorks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dayOfWork=DayOfWork::findOrFail($id);
        $dayOfWork->delete();

        SettingLog::log('danger', auth()->id(), 'Delete Day Of Work Start : '.$dayOfWork->start.' - End : '.$dayOfWork->end,null);
        session()->flash('success', 'Deleted Successfully !');
        return redirect()->route('dashboard.dayOfWorks.index');
    }
}
