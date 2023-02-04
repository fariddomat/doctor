<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\SettingLog;
use App\Type;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=Type::whenSearch(request()->search)->orderBy('name')->paginate(5);
        return view('dashboard.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.types.create');
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
            'name'=>'required|unique:types,name',
            'description' => 'required'
        ]);
        $type=Type::create($request->all());

        SettingLog::log('success', auth()->id(), 'Add New Type', route('dashboard.types.edit', $type->id));
        session()->flash('success', 'Created Successfully !');
        return redirect()->route('dashboard.types.index');
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
        $type=Type::findOrFail($id);
        return view('dashboard.types.edit', compact('type'));
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
            'name'=>'required|unique:types,name,'.$id,
            'description' => 'required'
        ]);
        $type=Type::findOrFail($id);
        $type->update($request->all());
        SettingLog::log('warning', auth()->id(), 'Update Type', route('dashboard.types.edit', $type->id));

        session()->flash('success', 'Updated Successfully !');
        return redirect()->route('dashboard.types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type=Type::findOrFail($id);
        $type->delete();
        SettingLog::log('danger', auth()->id(), 'Delete Type : '.$type->name, null);

        session()->flash('success', 'Deleted Successfully !');
        return redirect()->route('dashboard.types.index');
    }
}
