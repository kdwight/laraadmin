<?php

namespace App\Http\Controllers;

use App\Http\Resources\RolesResource;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return $this->rolesList();
        }

        return view('admin.users.index');
    }

    public function store()
    {
        $attr = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'access' => 'required|array'
        ]);

        Role::create(request()->all());

        return response(['success' => 'Role successfully created.'], 200);
    }
    public function update(Role $role)
    {
        $attr = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'access' => 'required|array'
        ]);

        $role->update($attr);


        return response(['success' => 'Role successfully updated.'], 200);
    }
    public function destroy(Role $role)
    {
        $role->delete();

        return response(['success' => 'Role successfully deleted.'], 200);
    }

    public function rolesList()
    {
        $query = Role::orderBy(request('column'), request('order'))
            ->where('name', 'like', '%' . request('filter') . '%'); //you can chain these with searchable columns

        return RolesResource::collection($query->paginate(request('per_page')));
    }
}
