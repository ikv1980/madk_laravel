<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarPhotoRequest;
use App\Http\Requests\Api\V1\UpdateCarPhotoRequest;
use App\Models\CarPhoto;

class CarPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CarPhoto $carPhoto)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarPhoto $carPhoto)
    {
        //
    }
}
