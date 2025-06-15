<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Models\User;
use App\Models\UserDepartment;
use App\Models\UserStatus;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = env('PAGINATION_COUNT', 20);
        $title = "Справочник \"Сотрудники\"";

        $data = [
            'title' => $title,
            'columns' => [
                'id',
                'login',
                'fullname',
                'department.department_name',
                'position.position_name',
                'start_work',
                'phone',
                'email',
                'birthday',
                'status.status_name',
                'status_at'],
            'headers' => ['ID', 'Логин', 'ФИО', 'Отдел', 'Должность', 'Дата приема', 'Телефон', 'E-mail', 'Дата рождения', 'Статус', 'Дата статуса'],
            'items' => User::with(['department', 'position', 'status'])->paginate($count),
            'route' => 'users',
        ];

        return view('user.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = UserDepartment::with('positions')->get();
        $statuses = UserStatus::all();

        $data = [
            'title' => 'Создание записи',
            'departments' => $departments,
            'statuses' => $statuses,
        ];

        return view('user.user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::query()->firstOrCreate($request->validated());
            message(__('Запись успешно создана.'), 'alert-success');
            return redirect()->route('users.show', $user->id);
        } catch (\Exception $e) {
            $error = __('Не удалось создать запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = [
            'title' => 'Просмотр записи',
        ];
        return view('user.user.show', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $departments = UserDepartment::with('positions')->get();
        $statuses = UserStatus::all();

        $data = [
            'title' => 'Редактирование записи',
            'departments' => $departments,
            'statuses' => $statuses,
        ];

        return view('user.user.edit', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            // Если пароль пустой, то удаляем из обновления
            if (empty($data['password'])) {
                unset($data['password']);
            }
            $user->update($data);
            message(__('Запись успешно изменена'), 'alert-info');
            return redirect()->route('users.show', $user->id);
        } catch (\Exception $e) {
            $error = __('Не удалось обновить запись: ' . $e->getMessage());
            message(($error), 'alert-danger');
            return redirect()->back()->withInput()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
