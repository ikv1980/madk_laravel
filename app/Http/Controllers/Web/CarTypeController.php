<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarTypeRequest;
use App\Http\Requests\Api\V1\UpdateCarTypeRequest;
use App\Models\CarType;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = env('PAGINATION_COUNT', 20);
        $title = "Типы кузовов";

        $data = [
            'title' => $title,
            'columns' => ['id', 'type_name'],
            'headers' => ['ID', 'Наименование'],
            'items' => CarType::paginate($count),
            'route' => 'car-types',
        ];

        return view('car.type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Создание записи',
        ];
        return view('car.type.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarTypeRequest $request)
    {
        try {
            $carType = CarType::query()->firstOrCreate($request->validated());
            message(__('Запись успешно создана.'), 'alert-success');
            return redirect()->route('car-types.show', $carType->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $carType)
    {
        $data = [
            'title' => 'Просмотр записи',
        ];
        return view('car.type.show', compact('data', 'carType'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarType $carType)
    {
        $data = [
            'title' => 'Редактирование записи',
        ];
        return view('car.type.edit', compact('data', 'carType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        try {
            $carType->update($request->validated());
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('car-types.show', $carType->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarType $carType)
    {
        $carType->delete();
        return redirect()->route('car-types.index');
    }
}
