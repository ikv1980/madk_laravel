<?php

use Illuminate\Support\Facades\Route;

// Форматирование даты для API (по умолчанию Y-m-d H:i:s)
if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        return $date ? \Carbon\Carbon::parse($date)->format($format) : null;
    }
}

// Информационное сообщение вверху
if (!function_exists('message')) {
    function message(string $text, string $style): void
    {
        session([
            'alert' => $text,
            'alert_style' => $style,
        ]);
    }
}
