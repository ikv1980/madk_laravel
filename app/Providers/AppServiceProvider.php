<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Лимитирование количества запросов
        RateLimiter::for('api', function (Request $request) {
            // Можно сделать по ролям число запросов
            $limit = env('API_RATE_LIMIT');

            $userId = $request->user()?->id;
            if ($userId && $request->user()->is_admin) {
                $limit = 100;
            }

            return Limit::perMinute($limit)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'Too Many Requests'
                    ], 429);
                });
        });
    }
}
