<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::where('company_id', auth()->user()->company_id)
            ->latest()
            ->get();

        return view('app.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('app.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => auth()->user()->company_id,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('app.users.index')
            ->with('success','User created successfully');
    }

    public function edit(User $user)
    {
        abort_if($user->company_id !== auth()->user()->company_id, 403);

        $roles = Role::all();
        return view('app.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->company_id !== auth()->user()->company_id, 403);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('app.users.index')
            ->with('success','User updated successfully');
    }

    public function destroy(User $user)
    {
        abort_if($user->company_id !== auth()->user()->company_id, 403);

        $user->delete();

        return back()->with('success','User deleted');
    }
}