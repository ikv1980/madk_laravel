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
        $carCountry = CarCountry::create($request->validated());
        return response()->json($carCountry, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarCountry $carCountry)
    {
        return response()->json($carCountry);
    }

    /**
     * Update CarCountry::self::all() ;the specified resource in storage.
     * return
     */
    public function update(UpdateCarCountryRequest $request, CarCountry $carCountry)
    {
        $carCountry->update($request->validated());
        return response()->json($carCountry);
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
