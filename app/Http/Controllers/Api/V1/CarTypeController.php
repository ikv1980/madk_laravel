<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use App\Http\Requests\StoreCarTypeRequest;
use App\Http\Requests\UpdateCarTypeRequest;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartypes = CarType::all();
        return response()->json($cartypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarTypeRequest $request)
    {
        try {
            $carType = CarType::create($request->validated());
            return response()->json($carType, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $carType)
    {
        return response()->json($carType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        try {
            $carType->update($request->validated());
            return response()->json($carType);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarType $carType)
    {
        $carType->delete();
        return response()->json(null, 204);
    }
}
