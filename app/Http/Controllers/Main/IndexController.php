<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $title = "Главная";
        return view('main.index', compact('title'));
    }
}
