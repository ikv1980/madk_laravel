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
        $carType = CarType::create($request->validated());
        return response()->json($carType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $carType)
    {
        return response()->json($carType);
    }

    /**
     * Update CarType::self::all() ;the specified resource in storage.
     * return
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        $carType->update($request->validated());
        return response()->json($carType);
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
