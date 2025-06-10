@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('user-departments.edit', $userDepartment->id) }}" class="btn btn-primary mr-auto">
                        {{ __('Редактировать') }}
                    </a>
                    <form action="{{ route('user-departments.destroy', $userDepartment->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <!--Пользовательские данные-->
                        <label>{{__('Название отдела')}}</label>
                        <input class="form-control" value="{{ $userDepartment->department_name }}" readonly>
                        <label>{{__('Описание отдела')}}</label>
                        <textarea class="form-control" readonly>{{ $userDepartment->department_description }}</textarea>
                        <label>{{__('E-mail')}}</label>
                        <input class="form-control" value="{{ $userDepartment->department_mail }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection
