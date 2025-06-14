@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('users.update', $user->id ) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <!--Пользовательские данные-->
                            <label>{{__('Фамилия')}}</label>
                            <input name="surname"
                                   value="{{ $user->surname }}"
                                   type="text"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Имя')}}</label>
                            <input name="firstname"
                                   value="{{ $user->firstname }}"
                                   type="text"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Отчество')}}</label>
                            <input name="patronymic"
                                   value="{{ $user->patronymic }}"
                                   type="text"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Дата рождения')}}</label>
                            <input name="birthday"
                                   value="{{ $user->birthday ? Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '' }}"
                                   type="date"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Телефон')}}</label>
                            <input name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   type="tel"
                                   class="form-control"
                                   placeholder="{{__('Формат ввода +79998887766')}}"
                                   pattern="\+7\d{10}">
                            <label>{{__('E-mail')}}</label>
                            <input name="email"
                                   value="{{ old('email', $user->email) }}"
                                   type="email"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Отдел')}}</label>
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
                            <label>{{__('Должность')}}</label>
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
                            <label>{{__('Дата приема')}}</label>
                            <input name="birthday"
                                   value="{{ $user->start_work ? Carbon\Carbon::parse($user->start_work)->format('Y-m-d') : '' }}"
                                   type="date"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Статус')}}</label>
                            <select
                                class="custom-select rounded-0"
                                id="status"
                                name="status_id">
                                <option value="">Выберите отдел</option>
                                @foreach($data['statuses'] as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $user->status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label>{{__('Дата статуса')}}</label>
                            <input name="birthday"
                                   value="{{ $user->status_at ? Carbon\Carbon::parse($user->status_at)->format('Y-m-d') : '' }}"
                                   type="date"
                                   class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Логин')}}</label>
                            <input name="login" value="{{ $user->login }}" type="text" class="form-control"
                                   placeholder="{{__('Введите значение')}}">
                            <label>{{__('Пароль')}}</label>
                            <input name="password" type="password" class="form-control" placeholder="{{__('Пароль')}}">
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
