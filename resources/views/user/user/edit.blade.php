@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('users.update', $user->id ) }}" method="post">
                    @csrf
                    @method('patch')
                    <!-- Данные формы -->
                    <div class="card-body">
                        <div>
                            <!-- Фамилия -->
                            <x-form-group-input
                                name="surname"
                                label="{{ __('Фамилия') }}"
                                value="{{ $user->surname }}"
                            />
                            <!-- Имя -->
                            <x-form-group-input
                                name="firstname"
                                label="{{ __('Имя') }}"
                                value="{{ $user->firstname }}"
                            />
                            <!-- Отчество -->
                            <x-form-group-input
                                name="patronymic"
                                label="{{ __('Отчество') }}"
                                value="{{ $user->patronymic }}"
                            />
                            <!-- Дата рождения -->
                            <x-form-group-input
                                name="birthday"
                                label="{{ __('Дата рождения') }}"
                                value="{{ $user->birthday_input }}"
                                type="date"
                            />
                            <!-- Телефон -->
                            <x-form-group-input
                                name="phone"
                                label="{{ __('Телефон') }}"
                                value="{{ old('phone', $user->phone) }}"
                                type="tel"
                                placeholder="{{ __('Формат ввода +79998887766') }}"
                                pattern="+7\d{10}"
                            />
                            <!-- Email -->
                            <x-form-group-input
                                name="email"
                                label="{{ __('E-mail') }}"
                                value="{{ old('email', $user->email) }}"
                                type="email"
                            />
                        </div>
                        <hr class="my-3 border-2 border-secondary opacity-50">
                        <div>
                            <!-- Отдел -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('Отдел')}}</label>
                                <div class="col-sm-9">
                                    <select
                                        class="custom-select rounded-0"
                                        id="department"
                                        name="department_id"
                                        onchange="updatePositions(this.value)">
                                        <option value="">Выберите отдел</option>
                                        @foreach($data['departments'] as $department)
                                            <option value="{{ $department->id }}"
                                                {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Должность -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('Должность')}}</label>
                                <div class="col-sm-9">
                                    <select
                                        class="custom-select rounded-0"
                                        id="position"
                                        name="position_id">
                                        <option value="">Сначала выберите отдел</option>
                                        @if($user->department_id)
                                            @php
                                                $selectedDepartment = $data['departments']->firstWhere('id', $user->department_id);
                                            @endphp
                                            @foreach($selectedDepartment->positions as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ $user->position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->position_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- Дата приема на работу -->
                            <x-form-group-input
                                name="start_work"
                                label="{{ __('Дата приема') }}"
                                value="{{ $user->start_work_input }}"
                                type="date"
                            />
                            <!-- Статус -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('Статус')}}</label>
                                <div class="col-sm-9">
                                    <select
                                        class="custom-select rounded-0"
                                        id="status"
                                        name="status_id">
                                        <option value="">Выберите статус</option>
                                        @foreach($data['statuses'] as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $user->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Дата статуса -->
                            <x-form-group-input
                                name="status_at"
                                label="{{ __('Дата статуса') }}"
                                value="{{ $user->status_at_input }}"
                                type="date"
                            />
                        </div>
                        <hr class="my-3 border-2 border-secondary opacity-50">
                        <div>
                            <!-- Логин -->
                            <x-form-group-input
                                name="login"
                                label="{{ __('Логин') }}"
                                value="{{ $user->login }}"
                            />
                            <!-- Пароль -->
                            <x-form-group-input
                                name="password"
                                label="{{ __('Пароль') }}"
                                type="password"
                                placeholder="{{__('Пароль')}}"
                            />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">{{__('Обновить')}}</button>
                            <!-- Ошибки -->
                            <x-errors/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-section>
@endsection

<script>
    // Собираем все должности по отделам в JS-объект
    const departmentPositions = {
        @foreach($data['departments'] as $department)
            {{ $department->id }}: [
                @foreach($department->positions as $position)
            {
                id: {{ $position->id }},
                name: "{{ $position->position_name }}",
                selected: {{ $user->position_id == $position->id ? 'true' : 'false' }}
            },
            @endforeach
        ],
        @endforeach
    };

    function updatePositions(departmentId) {
        const positionSelect = document.getElementById('position');
        positionSelect.innerHTML = '<option value="">Выберите должность</option>';

        if (departmentId && departmentPositions[departmentId]) {
            departmentPositions[departmentId].forEach(position => {
                const option = document.createElement('option');
                option.value = position.id;
                option.textContent = position.name;
                option.selected = position.selected;
                positionSelect.appendChild(option);
            });
        }
    }

    // Инициализация при загрузке
    document.addEventListener('DOMContentLoaded', function () {
        @if($user->department_id)
        updatePositions({{ $user->department_id }});
        @endif
    });
</script>
