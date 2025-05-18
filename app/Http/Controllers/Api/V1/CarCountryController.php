<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CarCountry;
use App\Http\Requests\StoreCarCountryRequest;
use App\Http\Requests\UpdateCarCountryRequest;

class CarCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carCountries = CarCountry::all();
        return response()->json($carCountries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarCountryRequest $request)
    {
        try {
            $carCountry = CarCountry::create($request->validated());
            return response()->json($carCountry, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarCountry $carCountry)
    {
        return response()->json($carCountry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarCountryRequest $request, CarCountry $carCountry)
    {
        try {
            $carCountry->update($request->validated());
            return response()->json($carCountry);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarCountry $carCountry)
    {
        $carCountry->delete();
        return response()->json(null, 204);
    }
}
