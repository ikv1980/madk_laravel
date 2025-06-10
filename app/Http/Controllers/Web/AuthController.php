<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('api.base_url') . '/api/v1';
    }

    public function show()
    {
        return view('auth.auth');
    }



    // Форма регистрации
    public function register()
    {
        return view('auth.register');
    }

    // Регистрация
    public function store(RegisterUserRequest $request)
    {
        $response = Http::post("{$this->apiUrl}/register", $request->all());

        if ($response->successful()) {
            return redirect()->route('auth.login');
        }

        return back()->withErrors(['error' => 'Ошибка регистрации']);
    }


    // Форма авторизации
    public function login()
    {
        return view('auth.login');
    }

    // Авторизация
    public function authenticate(LoginUserRequest $request)
    {
        $response = Http::post("{$this->apiUrl}/login", $request->all());

        if ($response->successful()) {
            session([
                'token' => $response['token'],
                'user' => $response['user']
            ]);
            message(__('Добро пожаловать в систему'), 'alert-success');
            return redirect()->route('home');
        }
        return back()->withErrors(['error' => 'Неверные логин или пароль']);
    }

    // Выход из системы
    public function logout()
    {
        $token = session('token');

        if ($token) {
            Http::withHeaders(['Authorization' => "Bearer {$token}"])
                ->post("{$this->apiUrl}/logout"); // Используем $apiUrl
        }

        session()->flush();

        return redirect()->route('login');
    }
}
