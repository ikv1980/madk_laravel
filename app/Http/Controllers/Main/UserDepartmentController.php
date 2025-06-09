<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\UserDepartment;
use Illuminate\Http\Request;

class UserDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = env('PAGINATION_COUNT', 20);
        $title = "Отделы";

        $data = [
            'title' => $title,
            'columns' => ['id', 'department_name', 'department_description', 'department_mail'],
            'headers' => ['ID', 'Наименование', 'Описание', 'E-mail'],
            'items' => UserDepartment::paginate($count),
            'route' => 'user-departments',
        ];

        return view('main.dictionary', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
