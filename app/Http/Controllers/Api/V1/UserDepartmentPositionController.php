<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserDepartmentPositionRequest;
use App\Http\Requests\Api\V1\UpdateUserDepartmentPositionRequest;
use App\Http\Resources\Api\V1\UserDepartmentPositionResource;
use App\Http\Resources\Api\V1\CarMarkResource;
use App\Models\CarMark;
use App\Models\UserDepartmentPosition;

class UserDepartmentPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserDepartmentPositionResource::collection(UserDepartmentPosition::with(['department', 'position'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDepartmentPositionRequest $request)
    {
        try {
            $userDepartmentPosition = UserDepartmentPosition::create($request->validated());
            return new UserDepartmentPositionResource($userDepartmentPosition->load(['department', 'position']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDepartmentPosition $userDepartmentPosition)
    {
        return new UserDepartmentPositionResource($userDepartmentPosition->load(['department', 'position']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserDepartmentPositionRequest $request, UserDepartmentPosition $userDepartmentPosition)
    {
        try {
            $userDepartmentPosition->update($request->validated());
            return new UserDepartmentPositionResource($userDepartmentPosition->load(['department', 'position']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDepartmentPosition $userDepartmentPosition)
    {
        try {
            // Мягкое удаление
            $userDepartmentPosition->delete();
            // Жесткое удаление
            // $userDepartmentPosition->forceDelete();
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
        $userDepartmentPosition = UserDepartmentPosition::withTrashed()->findOrFail($id);

        if (!$userDepartmentPosition->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $userDepartmentPosition->restore();

        return new UserDepartmentPositionResource($userDepartmentPosition->load(['department', 'position']));
    }
}
