<?php

namespace App\Http\Controllers\Dashboard;

use App\DateOfWork;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateOfWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateOfWorks=DateOfWork::paginate(5);
        return view('dashboard.dateOfWorks.index', compact('dateOfWorks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.dateOfWorks.create');
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
            'start'=>'required',
            'end'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        DateOfWork::create($request->all());
        session()->flash('success', 'Created Successfully !');
        return redirect()->route('dashboard.dateOfWorks.index');
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
        $dateOfWork=DateOfWork::findOrFail($id);
        return view('dashboard.dateOfWorks.edit', compact('dateOfWork'));
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
            'start'=>'required',
            'end'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        $dateOfWork=DateOfWork::findOrFail($id);
        $dateOfWork->update($request->all());

        session()->flash('success', 'Updated Successfully !');
        return redirect()->route('dashboard.dateOfWorks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dateOfWork=DateOfWork::findOrFail($id);
        $dateOfWork->delete();

        session()->flash('success', 'Deleted Successfully !');
        return redirect()->route('dashboard.dateOfWorks.index');
    }
}
