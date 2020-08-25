<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function store(UserRequest $request)
    {
        User::create($request->merge([
            'email_verified_at' => NOW(),
            'password' => bcrypt($request->get('password'))
        ])->all());

        return response(["success" => "User successfully created."], 200);
    }

    public function update(UserRequest $request, User $user)
    {
        if (auth()->id() !== 1 && $user->id === 1) {
            return response([
                'message' => 'oof..',
                'errors' => ['unauthorized' => ['Sorry, You\'re not allowed to modify this user.']]
            ], 403);
        }

        $user->update(
            $request->merge(['password' => bcrypt($request->get('password'))])
                ->except([$request->get('password') ?: 'password', 'password_confirmation'])
        );

        return response(['success' => 'User successfully updated.'], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response(['success' => 'User has been deleted.'], 200);
    }

    public function details($user)
    {
        // nested eagerloading of activities with its subject.
        return response()->json(User::with('activities.subject')->findOrFail($user), 200);
    }

    public function records()
    {
        $column = request('column');
        $order = request('order') === 'true' ? 'desc' : 'asc';

        $query = User::with('role')
            ->when($column !== 'undefined', function ($q) use ($column, $order) {
                return $q->orderBy($column, $order);
            })
            ->where('email', 'like', '%' . request('filter') . '%')
            ->orWhere('name', 'like', '%' . request('filter') . '%')
            ->orWhereHas('role', function ($query) { // where query for foreign table
                $query->where('name', 'like', '%' . request('filter') . '%');
            }); //you can chain these with searchable columns

        return JsonResource::collection($query->paginate(request('per_page')));
    }
}
