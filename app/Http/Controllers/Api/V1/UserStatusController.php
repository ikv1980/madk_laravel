<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserStatusRequest;
use App\Http\Requests\Api\V1\UpdateUserStatusRequest;
use App\Http\Resources\Api\V1\UserStatusResource;
use App\Models\UserStatus;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserStatusResource::collection(UserStatus::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserStatusRequest $request)
    {
        try {
            return new UserStatusResource(UserStatus::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserStatus $userStatus)
    {
        return new UserStatusResource($userStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserStatusRequest $request, UserStatus $userStatus)
    {
        try {
            $userStatus->update($request->validated());
            return new UserStatusResource($userStatus);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserStatus $userStatus)
    {
        try {
            // Мягкое удаление
            $userStatus->delete();
            // Жесткое удаление
            // $userStatus->forceDelete();
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
        $userStatus = UserStatus::withTrashed()->findOrFail($id);

        if (!$userStatus->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $userStatus->restore();

        return new UserStatusResource($userStatus);
    }
}
