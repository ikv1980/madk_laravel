@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('car-types.edit', $carType->id) }}" class="btn btn-primary mr-auto">
                        {{ __('Редактировать') }}
                    </a>
                    <form action="{{ route('car-types.destroy', $carType->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <!--Пользовательские данные-->
                        <label>{{__('Название типа кузова')}}</label>
                        <input type="text" class="form-control" id="field1" value="{{ $carType->type_name }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection
