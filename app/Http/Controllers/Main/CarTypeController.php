<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarTypeRequest;
use App\Http\Requests\Api\V1\UpdateCarTypeRequest;
use App\Models\CarType;
use Illuminate\Http\Request;

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

        return view('main.dictionary', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        message(__('Запись успешно создана'), 'alert-success');
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
            $object = CarType::query()->firstOrCreate($request->validated());

            if ($object->wasRecentlyCreated) {
                message(__('Запись успешно создана.'), 'alert-success');
            } else {
                message(__('Такая запись уже существует в БД.'), 'alert-warning');
            }
            return redirect()->route('car-types.show', $object->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $object)
    {
        session()->forget('alert');
        return view('car-types.show', compact('object'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarType $object)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarTypeRequest $request, CarType $object)
    {
        try {
            $object->update($request->validated());
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('car-types.show', $object->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
