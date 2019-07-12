<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except('edit_password', 'update_password');
    }

    public function edit_password(User $user)
    {
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
            'password' => 'required|confirmed'
        ]);

        if (!(Hash::check(request('old_password'), $user->password))) {
            return back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        return back()->with([
            'success' => "Password updated",
            'status' => 'success'
        ]);
    }

    public function roles()
    {
        $roles = Role::get();
        return view('admin.users.roles', compact('roles'));
    }

    public function store_role()
    {
        request()->validate([
            'name' => 'required',
            'access' => 'required',
            'description' => 'required',
        ]);

        Role::create([
            'name' => strtolower(str_replace(' ', '-', request('name'))),
            'access' => json_encode(request('access')),
            'description' => request('description')
        ]);

        return back()->with([
            'success' => "Role created",
            'status' => 'success'
        ]);
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

        return redirect('/admin/users/roles')->with([
            'success' => "Role updated",
            'status' => 'info'
        ]);
    }

    public function destroy_role(Role $role)
    {
        $role->delete();

        return redirect('/admin/users/roles')->with([
            'success' => "Role deleted",
            'status' => 'warning'
        ]);
    }

    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store()
    {
        request()->validate([
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            'type' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'username' => request('username'),
            'type' => request('type'),
            'password' => bcrypt(request('password'))
        ]);

        return redirect('/admin/users')->with([
            'success' => "User created",
            'status' => 'success'
        ]);
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
        request()->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'type' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if (request('password')) {
            $user->update([
                'password' => bcrypt(request('password'))
            ]);
        }

        $user->update([
            'username' => request('username'),
            'type' => request('type')
        ]);

        return redirect('/admin/users')->with([
            'success' => "User updated",
            'status' => 'info'
        ]);
    }

    public function status(User $user)
    {
        if (request()->expectsJson()) {
            $user->update([
                'status' => request('status')
            ]);

            return response()->json('Status has been updated', 200);
        }

        $user->update([
            'status' => request()->has('status')
        ]);

        return back()->with([
            'success' => "Status has been updated",
            'status' => 'info'
        ]);
    }

    public function destroy(User $user)
    {
        $user->update([
            'username' => $user->username . '_deleted' . NOW()
        ]);

        $user->delete();

        return redirect('/admin/users')->with([
            'success' => "User deleted",
            'status' => 'warning'
        ]);
    }

    public function userList()
    {
        $columns = array(
            0 => 'username'
        );

        $totalData = User::count();
        $totalFiltered = $totalData;
        $limit = request('length');
        $start = request('start');
        $order = $columns[request('order.0.column')];
        $dir = request('order.0.dir');

        if (empty(request('search.value'))) {
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = request('search.value');

            $users =  User::where('username', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = User::where('username', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                $nestedData['username'] = $user->username;
                $nestedData['type'] = $user->type;
                if ($user->id != 1) {
                    if ($user->status) {
                        $nestedData['status'] = '
                            <td>
                                <form action="/admin/users/' . $user->id . '/status" method="POST">
                                    ' . csrf_field() . method_field('PUT') . '
                                    <div class="custom-control custom-checkbox">
                                        <input id="active-' . $user->id . '" class="custom-control-input" type="checkbox" name="status" checked onChange="this.form.submit()">
                                        <label for="active-' . $user->id . '" class="custom-control-label">Active</label>
                                    </div>
                                </form>
                            </td>
                        ';
                    } else {
                        $nestedData['status'] = '
                            <td>
                                <form action="/admin/users/' . $user->id . '/status" method="POST">
                                    ' . csrf_field() . method_field('PUT') . '
                                    <div class="custom-control custom-checkbox">
                                        <input id="notactive-' . $user->id . '" class="custom-control-input" type="checkbox" name="status" onChange="this.form.submit()">
                                        <label for="notactive-' . $user->id . '" class="custom-control-label">Not Active</label>
                                    </div>
                                </form>
                            </td>
                        ';
                    }
                    $nestedData['action'] = '
                        <form class="confirmDelete d-flex justify-content-center" action="/admin/users/' . $user->id . '" method="POST" onsubmit="return confirm(\'Do you want to delete this item?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <a href="/admin/users/' . $user->id . '/edit"
                                class="btn btn-icons btn-rounded btn-success btn-sm" title="edit">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-icons btn-rounded btn-danger btn-sm" title="delete">
                                <i class="fas fa-user-times"></i>
                            </button>
                        </form>
                    ';
                } else {
                    $nestedData['status'] = '<td></td>';
                    $nestedData['action'] = '<td></td>';
                }

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval(request('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }
}
