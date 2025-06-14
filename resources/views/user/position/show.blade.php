@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('user-positions.edit', $userPosition->id) }}" class="btn btn-primary mr-auto">
                        {{ __('Редактировать') }}
                    </a>
                    <form action="{{ route('user-positions.destroy', $userPosition->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <!--Пользовательские данные-->
                        <label>{{__('Название отдела')}}</label>
                        <input class="form-control" value="{{ $userPosition->position_name }}" readonly>
                        <label>{{__('Описание отдела')}}</label>
                        <textarea class="form-control" readonly>{{ $userPosition->position_description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection
