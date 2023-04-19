<?php

namespace App\Http\Controllers\Dashboard;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Patient;
use App\SettingLog;
use App\User;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(true);
        $roles = Role::whereRoleNot(['admin'])->get();

        $users = User::whereRoleNot(['admin'])
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('roles')
            ->paginate(5);
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereRoleNot(['admin'])->get();
        return view('dashboard.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->attachRoles([$request->role_id]);
        if($request->role_id == 2){
            Doctor::create([
                'user_id' => $user->id,
                'spec' => 'spec',
                'qout' => 'qout',
                'img'  => 'img'
            ]);
        }elseif ($request->role_id == 4) {
            Patient::create([
                'user_id' => $user->id
            ]);
        }
        SettingLog::log('success', auth()->id(), 'Add New User : ' . $user->name, route('dashboard.users.edit', $user->id));

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
        $roles = Role::whereRoleNot(['admin'])->get();

        $user = User::findOrFail($id);
        return view('dashboard.users.edit', compact('roles', 'user'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|numeric',
        ]);
        $user = User::findOrFail($id);
        $oldRole=$user->roles->first()->id;
        // dd($oldRole);

        if ($oldRole != $request->role_id) {
            if($oldRole == 2){
                $doctor=Doctor::findOrFail($user->doctor->id);
                $doctor->delete();
            }elseif ($oldRole == 4) {
                $patient=Patient::findOrFail($user->patient->id);
                $patient->delete();
            }
            if($request->role_id == 2){
                Doctor::create([
                    'user_id' => $user->id,
                    'spec' => 'spec',
                    'qout' => 'qout',
                    'img'  => 'img'
                ]);
            }elseif ($request->role_id == 4) {
                Patient::create([
                    'user_id' => $user->id
                ]);
            }
        }
        $user->update($request->all());
        $user->syncRoles([$request->role_id]);

        SettingLog::log('warning', auth()->id(), 'Update User : ' . $user->name, route('dashboard.users.edit', $user->id));
        session()->flash('success', 'Successfully updated !');
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
        $user = User::findOrFail($id);
        $user->delete();

        SettingLog::log('danger', auth()->id(), 'Delete User : ' . $user->name, null);
        session()->flash('success', 'Successfully deleted !');
        return redirect()->route('dashboard.users.index');
    }

    public function ban($id)
    {

        $user = User::findOrFail($id);
        if ($user) {
            $user->update([
                'status' => 'ban'
            ]);

            SettingLog::log('info', auth()->id(), 'Banned User : ' . $user->name, route('dashboard.users.edit', $user->id));
            session()->flash('success', 'Successfully Ban !');
            return redirect()->route('dashboard.users.index');
        } else
            return response()->json(['message' => 'error'], 404);
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->update([
                'status' => 'active'
            ]);

            SettingLog::log('info', auth()->id(), 'Un Bannde User : ' . $user->name, route('dashboard.users.edit', $user->id));
            session()->flash('success', 'Successfully unBan !');
            return redirect()->route('dashboard.users.index');
        } else
            return response()->json(['message' => 'error'], 404);
    }
}
