<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserDepartmentRequest;
use App\Http\Requests\Api\V1\UpdateUserDepartmentRequest;
use App\Models\UserDepartment;

class UserDepartmentController extends Controller
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
            'columns' => ['id', 'department_name', 'department_description', 'department_mail'],
            'headers' => ['ID', 'Наименование', 'Описание департамента','E-mail'],
            'items' => UserDepartment::paginate($count),
            'route' => 'user-departments',
        ];

        return view('user.department.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Создание записи',
        ];
        return view('user.department.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDepartmentRequest $request)
    {
        try {
            $userDepartment = UserDepartment::query()->firstOrCreate($request->validated());
            message(__('Запись успешно создана.'), 'alert-success');
            return redirect()->route('user-departments.show', $userDepartment->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDepartment $userDepartment)
    {
        $data = [
            'title' => 'Просмотр записи',
        ];
        return view('user.department.show', compact('data', 'userDepartment'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDepartment $userDepartment)
    {
        $data = [
            'title' => 'Редактирование записи',
        ];
        return view('user.department.edit', compact('data', 'userDepartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserDepartmentRequest $request, UserDepartment $userDepartment)
    {
        try {
            $userDepartment->update($request->validated());
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('user-departments.show', $userDepartment->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDepartment $userDepartment)
    {
        $userDepartment->delete();
        return redirect()->route('user-departments.index');
    }
}
