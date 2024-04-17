<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{
    public function index()
    {
        return response()->success(UserResource::collection(User::all()));
    }

    public function store($request)
    {
        $user = User::create($request->validated());
        return response()->success(new UserResource($user), 'User created successfully', 201);
    }

    public function show(string $id)
    {
        return response()->success(new UserResource(User::findOrFail($id)), null, 200);
    }

    public function update($request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->success(new UserResource($user), 'User updated successfully', 200);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
