@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('user-positions.update', $userPosition->id ) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <!--Пользовательские данные-->
                            <label>{{__('Название отдела')}}</label>
                            <input name="position_name" value="{{ $userPosition->position_name }}" type="text" class="form-control" placeholder="{{__('Введите значение')}}">
                            <label>{{__('Описание отдела')}}</label>
                            <textarea name="position_description" type="text" class="form-control" placeholder="{{__('Введите значение')}}">{{ $userPosition->position_description }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('Обновить')}}</button>
                        <x-errors/>
                    </div>
                </form>
            </div>
        </div>
    </x-section>
@endsection

