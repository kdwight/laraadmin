<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UsersResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $query = User::orderBy(request('column'), request('order'))
                ->where('username', 'like', '%' . request('filter') . '%'); //you can chain these with searchable columns

            return UsersResource::collection($query->paginate(request('per_page')));
        }

        return view('admin.index');
    }

    public function store(UserRequest $request, User $model)
    {
        event(new Registered($model->create($request->merge(['password' => Hash::make($request->get('password'))])->except('password_confirmation'))));

        return response(['success' => 'User successfully created.'], 200);
    }

    public function edit(User $user)
    {
        if (request()->wantsJson()) {
            return response($user);
        }

        return view('admin.index');
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password', 'password_confirmation'])
        );

        return response(['success' => 'User successfully updated.'], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response(['success' => 'User successfully deleted.'], 200);
    }

    public function status(User $user)
    {
        $user->update([
            'status' => request('status')
        ]);

        return response(['success' => 'Status has been updated'], 200);
    }
}
