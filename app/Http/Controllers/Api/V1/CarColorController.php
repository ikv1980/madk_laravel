<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CarColor;
use App\Http\Requests\StoreCarColorRequest;
use App\Http\Requests\UpdateCarColorRequest;
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
        $carColor = CarColor::create($request->validated());
        return response()->json($carColor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarColor $carColor)
    {
        return response()->json($carColor);
    }

    /**
     * Update CarColor::self::all() ;the specified resource in storage.
     * return
     */
    public function update(UpdateCarColorRequest $request, CarColor $carColor)
    {
        $carColor->update($request->validated());
        return response()->json($carColor);
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
