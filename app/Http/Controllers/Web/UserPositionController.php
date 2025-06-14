<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserPositionRequest;
use App\Http\Requests\Api\V1\UpdateUserPositionRequest;
use App\Models\UserPosition;

class UserPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = env('PAGINATION_COUNT', 20);
        $title = "Список отделов";

        $data = [
            'title' => $title,
            'columns' => ['id', 'position_name', 'position_description'],
            'headers' => ['ID', 'Наименование', 'Описание должности'],
            'items' => UserPosition::paginate($count),
            'route' => 'user-positions',
        ];

        return view('user.position.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Создание записи',
        ];
        return view('user.position.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserPositionRequest $request)
    {
        try {
            $userPosition = UserPosition::query()->firstOrCreate($request->validated());
            message(__('Запись успешно создана.'), 'alert-success');
            return redirect()->route('user-positions.show', $userPosition->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPosition $userPosition)
    {
        $data = [
            'title' => 'Просмотр записи',
        ];
        return view('user.position.show', compact('data', 'userPosition'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPosition $userPosition)
    {
        $data = [
            'title' => 'Редактирование записи',
        ];
        return view('user.position.edit', compact('data', 'userPosition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPositionRequest $request, UserPosition $userPosition)
    {
        try {
            $userPosition->update($request->validated());
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('user-positions.show', $userPosition->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPosition $userPosition)
    {
        $userPosition->delete();
        return redirect()->route('user-positions.index');
    }
}
