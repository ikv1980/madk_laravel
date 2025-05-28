<?php

use Illuminate\Support\Facades\Route;

// Форматирование даты для API (по умолчанию Y-m-d H:i:s)
if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        return $date ? \Carbon\Carbon::parse($date)->format($format) : null;
    }
}
