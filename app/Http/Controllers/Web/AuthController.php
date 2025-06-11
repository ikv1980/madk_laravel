<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Общая форма регистрации/авторизации
    public function show()
    {
        return view('auth.auth');
    }

//    // Форма регистрации
//    public function register()
//    {
//        return view('auth.register');
//    }

    // Регистрация
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        try {
            User::query()->create($request->validated());
            message(__('Регистрация успешно завершена. Дождитесь подтверждения прав.'), 'alert-success');
            return redirect()->route('auth.show');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ошибка при регистрации: '.$e->getMessage()]);
        }
    }

    // Форма авторизации
//    public function login()
//    {
//        return view('auth.login');
//    }

    // Авторизация
    public function authenticate(LoginUserRequest $request): RedirectResponse
    {
        // Нужно подтверждение от Админа о доступе
        // Время сессии не более 120 часов или при выходе со страницы
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            message(__('Добро пожаловать в систему'), 'alert-success');
            return redirect()->route('home');
        }

        return back()->withErrors([
            'error' => 'Неверные логин или пароль',
        ])->onlyInput('login');
    }

    // Выход из системы
    public function logout(Request $request)
    {
        // Выход из системы через Laravel Auth
        Auth::logout();

        // Очистка сессии
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Редирект на страницу входа с сообщением
        message(__('Вы успешно вышли из системы'), 'alert-info');
        return redirect()->route('auth.show');
    }
}
