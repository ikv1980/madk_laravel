<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarPhotoRequest;
use App\Http\Requests\Api\V1\UpdateCarPhotoRequest;
use App\Http\Resources\Api\V1\CarPhotoResource;
use App\Models\CarPhoto;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CarPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarPhotoResource::collection(CarPhoto::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarPhotoRequest $request)
    {
        $validated = $request->validated();
        $file = $request->file('photo');

        try {
            // Генерация имени файла
            $filename = $file->hashName();
            $directory = "photo/{$validated['car_id']}";

            // Сохранение файла
            $file->storeAs($directory, $filename, 'minio');

            // Путь внутри бакета (без протокола и хоста)
            $pathInsideBucket = "$directory/$filename";

            // Генерация полного URL
            $fullUrl = Storage::disk('minio')->url($pathInsideBucket);

            // Сохранение в БД
            $carPhoto = CarPhoto::create([
                'car_id' => $validated['car_id'],
                'url' => $fullUrl,
            ]);

            return new CarPhotoResource($carPhoto);
        } catch (\Exception $e) {
            return response()->json(['error' => "Ошибка загрузки фото: " . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarPhoto $carPhoto)
    {
        return new CarPhotoResource($carPhoto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarPhoto $carPhoto)
    {
        try {
            if (Storage::disk('minio')->exists($carPhoto->url)) {
                Storage::disk('minio')->delete($carPhoto->url);
            }
            $carPhoto->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete photo'], 500);
        }
    }

    // Фото конкретного авто
    public function showByCar(Car $car)
    {
        return CarPhotoResource::collection($car->photos);
    }
}
