<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserPositionRequest;
use App\Http\Requests\Api\V1\UpdateUserPositionRequest;
use App\Http\Resources\Api\V1\UserPositionResource;
use App\Models\UserPosition;

class UserPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserPositionResource::collection(UserPosition::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserPositionRequest $request)
    {
        try {
            return new UserPositionResource(UserPosition::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPosition $userPosition)
    {
        return new UserPositionResource($userPosition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPositionRequest $request, UserPosition $userPosition)
    {
        try {
            $userPosition->update($request->validated());
            return new UserPositionResource($userPosition);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPosition $userPosition)
    {
        try {
            // Мягкое удаление
            $userPosition->delete();
            // Жесткое удаление
            // $userPosition->forceDelete();
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
        $userPosition = UserPosition::withTrashed()->findOrFail($id);

        if (!$userPosition->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $userPosition->restore();

        return new UserPositionResource($userPosition);
    }
}
