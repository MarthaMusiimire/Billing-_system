<?php

namespace  App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use  Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    

    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request)
    {

        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User created successfully with roles');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status','User Deleted Successfully');
    }

    public function inactive()
    {
        $inactiveUsers = User::onlyTrashed()->with('roles')->get();//for returning users with their roles.
        return view('role-permission.user.inactive', compact('inactiveUsers'));
    }

    public function restore($id)
{
    $user = User::onlyTrashed()->findOrFail($id);
    $user->restore();

    return redirect()->route('users.index')->with('status', 'User restored successfully.');
}
}