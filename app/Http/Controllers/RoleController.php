<?php

namespace App\Http\Controllers;

use App\Role;

class RoleController extends Controller
{
    public function roles()
    {
        return response()->json(Role::all(), 200);
    }

    public function store()
    {
        $attr = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'modules' => 'required|array'
        ]);

        Role::create(request()->all());

        return response(['success' => 'Role successfully created.'], 201);
    }

    public function update(Role $role)
    {
        $attr = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'modules' => 'required|array'
        ]);

        $role->update($attr);

        return response(['success' => 'Role successfully updated.'], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response(['success' => 'Role successfully deleted.'], 200);
    }
}
