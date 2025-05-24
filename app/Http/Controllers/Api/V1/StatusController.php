<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStatusRequest;
use App\Http\Requests\Api\V1\UpdateStatusRequest;
use App\Http\Resources\Api\V1\StatusResource;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StatusResource::collection(Status::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        try {
            return new StatusResource(Status::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return new StatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        try {
            $status->update($request->validated());
            return new StatusResource($status);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        try {
            // Мягкое удаление
            $status->delete();
            // Жесткое удаление
             $status->forceDelete();
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
        $status = Status::withTrashed()->findOrFail($id);

        if (!$status->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $status->restore();

        return new StatusResource($status);
    }
}
