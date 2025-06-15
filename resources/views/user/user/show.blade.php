@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mr-auto">
                        {{ __('Редактировать') }}
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                    </form>
                </div>
                <!-- Данные формы -->
                <div class="card-body">
                    <div>
                        <!-- Фамилия -->
                        <x-form-group-input
                            name="surname"
                            label="{{ __('Фамилия') }}"
                            value="{{ $user->surname }}" readonly
                        />
                        <!-- Имя -->
                        <x-form-group-input
                            name="firstname"
                            label="{{ __('Имя') }}"
                            value="{{ $user->firstname }}" readonly
                        />
                        <!-- Отчество -->
                        <x-form-group-input
                            name="patronymic"
                            label="{{ __('Отчество') }}"
                            value="{{ $user->patronymic }}" readonly
                        />
                        <!-- Дата рождения -->
                        <x-form-group-input
                            name="birthday"
                            label="{{ __('Дата рождения') }}"
                            value="{{ $user->birthday_input }}" readonly
                            type="date"
                        />
                        <!-- Телефон -->
                        <x-form-group-input
                            name="phone"
                            label="{{ __('Телефон') }}"
                            value="{{ old('phone', $user->phone) }}" readonly
                            type="tel"
                            placeholder="{{ __('Формат ввода +79998887766') }}"
                            pattern="+7\d{10}"
                        />
                        <!-- Email -->
                        <x-form-group-input
                            name="email"
                            label="{{ __('E-mail') }}"
                            value="{{ old('email', $user->email) }}" readonly
                            type="email"
                        />
                    </div>
                    <hr class="my-3 border-2 border-secondary opacity-50">
                    <div>
                        <!-- Отдел -->
                        <x-form-group-input
                            name="department_id"
                            label="{{ __('Отдел') }}"
                            value="{{ $user->department->department_name ?? 'Не указано' }}" readonly
                        />
                        <!-- Должность -->
                        <x-form-group-input
                            name="position_id"
                            label="{{ __('Должность') }}"
                            value="{{ $user->position->position_name ?? 'Не указано' }}" readonly
                        />
                        <!-- Дата приема на работу -->
                        <x-form-group-input
                            name="start_work"
                            label="{{ __('Дата приема') }}"
                            value="{{ $user->start_work_input }}" readonly=""
                            type="date"
                        />
                        <!-- Статус -->
                        <x-form-group-input
                            name="status_id"
                            label="{{ __('Статус') }}"
                            value="{{ $user->status->status_name ?? 'Не указано' }}" readonly
                        />
                        <!-- Дата статуса -->
                        <x-form-group-input
                            name="status_at"
                            label="{{ __('Дата статуса') }}"
                            value="{{ $user->status_at_input }}" readonly=""
                            type="date"
                        />
                    </div>
                    <hr class="my-3 border-2 border-secondary opacity-50">
                    <div>
                        <!-- Логин -->
                        <x-form-group-input
                            name="login"
                            label="{{ __('Логин') }}"
                            value="{{ $user->login }}" readonly=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </x-section>
@endsection
