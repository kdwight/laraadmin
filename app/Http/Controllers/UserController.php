<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\Exports\UsersExport;

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
        $this->validate(request(), [
            'old_password' => 'required',
            'password' => 'required | confirmed'
        ]);

        if (!(Hash::check(request('old_password'), $user->password))) {
            return back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        return redirect('users')->with('success', 'Password updated');
    }

    public function export_users()
    {
        // \Excel::store(new UsersExport(2018), 'users.xlsx');
        return (new UsersExport)->download('users.xlsx');
    }

    public function roles()
    {
        $roles = Role::get();
        return view('admin.users.roles', compact('roles'));
    }

    public function store_role()
    {
        $this->validate(request(), [
            'name' => 'required',
            'access' => 'required',
            'description' => 'required',
        ]);

        Role::create([
            'name' => strtolower(str_replace(' ', '-', request('name'))),
            'access' => json_encode(request('access')),
            'description' => request('description')
        ]);

        return back()->with('success', 'Role created');
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
        $this->validate(request(), [
            'name' => 'required',
            'access' => 'required',
            'description' => 'required',
        ]);

        $role->update([
            'name' => strtolower(str_replace(' ', '-', request('name'))),
            'access' => json_encode(request('access')),
            'description' => request('description')
        ]);

        return redirect('/users/roles')->with('success', 'Role updated');
    }

    public function destroy_role(Role $role)
    {
        $role->delete();
        return redirect('/users/roles')->with('success', 'Role deleted');
    }

    public function index()
    {
        $users = User::orderBy('order', 'ASC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function updateOrder()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->timestamps = false;
            $id = $user->id;

            foreach (request('order') as $order) {
                if ($order['id'] == $id) {
                    $user->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
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
            'password' => bcrypt(request('password')),
            'created_by' => auth()->id()
        ]);

        return redirect('/users')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        if ($user->id != 1) {
            return view('admin.users.edit', compact('user', 'roles'));
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
            'password' => bcrypt(request('password')),
            'updated_by' => auth()->id()
        ]);

        return redirect('/users')->with('success', 'User updated');
    }

    public function status(User $user)
    {
        $user->update([
            'status' => request()->has('status'),
            'updated_by' => auth()->id()
        ]);
        return back()->with('success', 'Status has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User deleted');
    }
}
