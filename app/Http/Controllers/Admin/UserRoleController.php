<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;


class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit-roles', compact('user','roles'));
    }


   public function update(Request $request, User $user)
    {
        if ($user->company_id === null) {
            return back()->with('error', 'Super Admin role cannot be modified.');
        }

        $request->validate([
            'roles' => 'nullable|array'
        ]);

        app(\Spatie\Permission\PermissionRegistrar::class)
            ->setPermissionsTeamId($user->company_id);

        $user->syncRoles($request->roles ?? []);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Roles updated successfully');
    }
}