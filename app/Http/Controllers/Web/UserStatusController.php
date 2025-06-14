<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserStatusRequest;
use App\Http\Requests\Api\V1\UpdateUserStatusRequest;
use App\Models\UserStatus;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = env('PAGINATION_COUNT', 20);
        $title = "Справочник \"Статусы\"";

        $data = [
            'title' => $title,
            'columns' => ['id', 'status_name', 'status_number'],
            'headers' => ['ID', 'Наименование', 'Номер статуса'],
            'items' => UserStatus::paginate($count),
            'route' => 'user-statuses',
        ];

        return view('user.status.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Создание записи',
        ];
        return view('user.status.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserStatusRequest $request)
    {
        try {
            $userStatus = UserStatus::query()->firstOrCreate($request->validated());
            message(__('Запись успешно создана.'), 'alert-success');
            return redirect()->route('user-statuses.show', $userStatus->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserStatus $userStatus)
    {
        $data = [
            'title' => 'Просмотр записи',
        ];
        return view('user.status.show', compact('data', 'userStatus'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserStatus $userStatus)
    {
        $data = [
            'title' => 'Редактирование записи',
        ];
        return view('user.status.edit', compact('data', 'userStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserStatusRequest $request, UserStatus $userStatus)
    {
        try {
            $userStatus->update($request->validated());
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('user-statuses.show', $userStatus->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserStatus $userStatus)
    {
        $userStatus->delete();
        return redirect()->route('user-statuses.index');
    }
}
