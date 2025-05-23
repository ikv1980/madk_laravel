<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with(['department', 'position', 'status'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return new UserResource($user->load(['department', 'position', 'status']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user->load(['department', 'position', 'status']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());
            return new UserResource($user->load(['department', 'position', 'status']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Мягкое удаление
            $user->delete();
            // Жесткое удаление
            // $user->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (!$user->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $user->restore();

        return new UserResource($user->load(['department', 'position', 'status']));
    }
}
