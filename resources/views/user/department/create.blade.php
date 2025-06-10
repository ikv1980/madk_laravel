@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('user-departments.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <!--Пользовательские данные-->
                            <label>{{__('Название отдела')}}</label>
                            <input name="department_name" type="text" class="form-control" placeholder="{{__('Введите значение')}}">
                            <label>{{__('Описание отдела')}}</label>
                            <textarea name="department_description" type="text" class="form-control" placeholder="{{__('Введите значение')}}"></textarea>
                            <label>{{__('E-mail')}}</label>
                            <input name="department_mail" type="email" class="form-control" placeholder="{{__('Введите значение')}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('Создать')}}</button>
                        <x-errors/>
                    </div>
                </form>
            </div>
        </div>
    </x-section>
@endsection

