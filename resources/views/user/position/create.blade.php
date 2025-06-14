@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('user-positions.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <!--Пользовательские данные-->
                            <label>{{__('Название должности')}}</label>
                            <input name="position_name" type="text" class="form-control" placeholder="{{__('Введите значение')}}">
                            <label>{{__('Описание должности')}}</label>
                            <textarea name="position_description" type="text" class="form-control" placeholder="{{__('Введите значение')}}"></textarea>
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

