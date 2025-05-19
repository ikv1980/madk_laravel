<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarColorRequest;
use App\Http\Requests\Api\V1\UpdateCarColorRequest;
use App\Models\CarColor;

class CarColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carColors = CarColor::all();
        return response()->json($carColors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarColorRequest $request)
    {
        try {
            $carColor = CarColor::create($request->validated());
            return response()->json($carColor, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarColor $carColor)
    {
        return response()->json($carColor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarColorRequest $request, CarColor $carColor)
    {
        try {
            $carColor->update($request->validated());
            return response()->json($carColor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarColor $carColor)
    {
        $carColor->delete();
        return response()->json(null, 204);
    }
}
