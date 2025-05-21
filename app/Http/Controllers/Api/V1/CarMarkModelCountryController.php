<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarMarkModelCountryRequest;
use App\Http\Requests\Api\V1\UpdateCarMarkModelCountryRequest;
use App\Http\Resources\Api\V1\CarMarkModelCountryResource;
use App\Http\Resources\Api\V1\CarMarkResource;
use App\Models\CarMark;
use App\Models\CarMarkModelCountry;

class CarMarkModelCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarMarkModelCountryResource::collection(CarMarkModelCountry::with(['mark', 'model', 'country'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarMarkModelCountryRequest $request)
    {
        try {
            return new CarMarkModelCountryResource(CarMarkModelCountry::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarMarkModelCountry $carMarkModelCountry)
    {
        return new CarMarkModelCountryResource($carMarkModelCountry->load(['mark', 'model', 'country']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarMarkModelCountryRequest $request, CarMarkModelCountry $carMarkModelCountry)
    {
        try {
            $carMarkModelCountry->update($request->validated());
            return new CarMarkModelCountryResource($carMarkModelCountry->load(['mark', 'model', 'country']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarMarkModelCountry $carMarkModelCountry)
    {
        $carMarkModelCountry->delete();
        return response()->json(null, 204);
    }
}
