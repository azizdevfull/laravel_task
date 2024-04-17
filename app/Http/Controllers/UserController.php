<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get all users",
     *     @OA\Response(
     *         response=200,
     *         description="List of users",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+9999999"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return $this->userService->index();
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(
     *             required={"phone", "password"},
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="New user created",
     *        @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User created successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+9999999"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreUserRequest $request)
    {
        return $this->userService->store($request);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Get a specific user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details",
     *        @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+9999999"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function show(string $id)
    {
        return $this->userService->show($id);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Update a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated user data",
     *         @OA\JsonContent(
     *             required={"phone", "password"},
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="phone", type="string", example="+9999999"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        return $this->userService->update($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Delete a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="User deleted successfully"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function destroy(string $id)
    {
        return $this->userService->destroy($id);
    }
}
