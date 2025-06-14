@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('user-statuses.edit', $userStatus->id) }}" class="btn btn-primary mr-auto">
                        {{ __('Редактировать') }}
                    </a>
                    <form action="{{ route('user-statuses.destroy', $userStatus->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <!--Пользовательские данные-->
                        <label>{{__('Название статуса')}}</label>
                        <input class="form-control" value="{{ $userStatus->status_name }}" readonly>
                        <label>{{__('Номер статуса')}}</label>
                        <input class="form-control" value="{{ $userStatus->status_number }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection
