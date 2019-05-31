<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\Exports\UsersExport;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except('edit_password', 'update_password');
    }

    public function edit_password($user)
    {
        $user = User::find($user);
        if ($user) {
            if (auth()->id() == $user->id) {
                return view('admin.users.password', compact('user'));
            }
            return back();
        } else {
            return back();
        }
    }

    public function update_password(User $user)
    {
        request()->validate([
            'old_password' => 'required',
            'password' => 'required | confirmed'
        ]);

        if (!(Hash::check(request('old_password'), $user->password))) {
            return response(["not_match" => "Your current password does not matches with the password you provided. Please try again."], 422);
        }

        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        return response('Password updated', 200);
    }

    public function roles()
    {
        $roles = Role::get();
        if (request()->ajax()) {
            return response($roles);
        }
        return view('admin.users.roles', compact('roles'));
    }

    public function store_role()
    {
        request()->validate([
            'name' => 'required',
            'access' => 'required',
            'description' => 'required',
        ]);

        $role = Role::create([
            'name' => strtolower(str_replace(' ', '-', request('name'))),
            'access' => json_encode(request('access')),
            'description' => request('description')
        ]);

        return response()->json(['role' => $role, 'sucess' => 'Role created'], 200);
    }

    public function edit_role(Role $role)
    {
        if ($role->id != 1) {
            return view('admin.users.edit_roles', compact('role'));
        }

        return back();
    }

    public function update_role(Role $role)
    {
        request()->validate([
            'name' => 'required',
            'access' => 'required',
            'description' => 'required',
        ]);

        $role->update([
            'name' => strtolower(str_replace(' ', '-', request('name'))),
            'access' => json_encode(request('access')),
            'description' => request('description')
        ]);

        return response()->json(['success' => 'Role updated'], 200);
    }

    public function destroy_role(Role $role)
    {
        $role->delete();

        if (request()->expectsJson()) {
            return response()->json('Role deleted', 200);
        }

        return redirect('/users/roles')->with('success', 'Role deleted');
    }

    public function index()
    {
        if (request()->wantsJson()) {
            $query = User::orderBy(request('column'), request('order'))->where('username', 'like', '%' . request('filter') . '%');
            $users = $query->paginate(request('per_page'));
            return UserResource::collection($users);
        }

        return view('admin.users.index');
    }

    public function store()
    {
        $this->validate(request(), [
            'username' => 'required',
            'type' => 'required',
            'password' => 'required | confirmed',
        ]);

        User::create([
            'username' => request('username'),
            'type' => request('type'),
            'password' => bcrypt(request('password'))
        ]);

        return response()->json('User created', 200);
    }

    public function edit(User $user)
    {
        if ($user->id != 1) {
            return view('admin.users.edit', compact('user'));
        }

        return back();
    }

    public function update(User $user)
    {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'nullable | confirmed',
        ]);

        $user->update([
            'username' => request('username'),
            'type' => request('type'),
            'password' => bcrypt(request('password'))
        ]);

        return response()->json('User updated', 200);
    }

    public function status(User $user)
    {
        $user->update([
            'status' => request('status')
        ]);

        if (request()->expectsJson()) {
            return response()->json('status updated', 200);
        }

        return back()->with('success', 'Status has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        if (request()->expectsJson()) {
            return response()->json('User deleted', 200);
        }

        return redirect('/users')->with('success', 'User deleted');
    }
}
