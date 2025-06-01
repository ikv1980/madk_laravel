<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя.
     */
    public function register(RegisterUserRequest $request)
    {
        try {
            return User::create($request->validated());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 422);
        }
    }

    /**
     * Авторизация пользователя.
     */
    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'Неверный логин или пароль.'
            ], 401);
        };

        $user = User::query()
            ->where('login', $request->validated()['login'])
            ->whereNotNull('status_id')
            ->whereNot('status_id', 2)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Пользователь не активен'], 403);
        }

        // Проверка и удаление старых токенов
        $tokens_count = $user->tokens()->count();
        if ($user->tokens()->count() >= 2) {
            $user->tokens()->orderBy('created_at', 'asc')->take($tokens_count - 1)->delete();
        }

        return response()->json([
            'user' => $user->only(['id', 'login', 'firstname', 'surname']),
            'token' => $user->createToken('MyApp')->plainTextToken,
        ]);
    }

    /**
     * Выход пользователя из системы.
     */
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Пользователь вышел из системы']);
    }
}
