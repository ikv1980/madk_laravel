@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('user-statuses.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <!--Пользовательские данные-->
                            <label>{{__('Название статуса')}}</label>
                            <input name="status_name" type="text" class="form-control" placeholder="{{__('Введите значение')}}">
                            <label>{{__('Номер статуса')}}</label>
                            <input name="status_number" type="number" class="form-control" placeholder="{{__('Введите значение')}}">
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

