<x-section>
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('users.update', Auth::user()->id) }}" method="post">
                @csrf
                @method('patch')
                <!-- Данные формы -->
                <div class="card-body">
                    <div class="card-header">
                        <!-- Полное ФИО -->
                        <label class="col-sm-6 text-uppercase h3 fw-normal">
                            <p class="fw-light">{{ Auth::user()->fullname }}</p></label>
                    </div>
                    <div class="card-body">
                        <div class="bootstrap-duallistbox-container row moveonselect moveondoubleclick">
                            <div class="box1 col-md-6">
                                <h4>{{__('Личная информация')}}</h4>
                                <hr class="my-3 border-2 border-secondary opacity-50">
                                <div>
                                    <!-- Логин -->
                                    <x-form-group-input
                                        name="login"
                                        label="{{ __('Логин') }}"
                                        value="{{ Auth::user()->login }}" readonly
                                    />
                                    <!-- Пароль -->
                                    <x-form-group-input
                                        name="password"
                                        label="{{ __('Пароль') }}"
                                        type="password"
                                        placeholder="{{__('Пароль')}}"
                                        addClass="is-warning"
                                    />
                                    <!-- Email -->
                                    <x-form-group-input
                                        name="email"
                                        label="{{ __('E-mail') }}"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        type="email"
                                        addClass="is-warning"
                                    />
                                    <!-- Телефон -->
                                    <x-form-group-input
                                        name="phone"
                                        label="{{ __('Телефон') }}"
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                        type="tel"
                                        placeholder="{{ __('Формат ввода +79998887766') }}"
                                        pattern="+7\d{10}"
                                        addClass="is-warning"
                                    />
                                    <!-- Дата рождения -->
                                    <x-form-group-input
                                        name="birthday"
                                        label="{{ __('Дата рождения') }}"
                                        value="{{ Auth::user()->birthday_input }}" readonly
                                        type="date"
                                    />
                                </div>
                            </div>
                            <div class="box1 col-md-6">
                                <h4>{{__('Служебная информация')}}</h4>
                                <hr class="my-3 border-2 border-secondary opacity-50">
                                <div>
                                    <!-- Отдел -->
                                    <x-form-group-input
                                        name="department_name"
                                        label="{{ __('Отдел') }}"
                                        value="{{ Auth::user()->department->department_name ?? 'Не указано' }}" readonly
                                    />
                                    <!-- Должность -->
                                    <x-form-group-input
                                        name="position_name"
                                        label="{{ __('Должность') }}"
                                        value="{{ Auth::user()->position->position_name ?? 'Не указано' }}" readonly
                                    />
                                    <!-- Дата приема на работу -->
                                    <x-form-group-input
                                        name="start_work"
                                        label="{{ __('Дата приема') }}"
                                        value="{{ Auth::user()->start_work_input }}" readonly
                                        type="date"
                                    />
                                    <!-- Статус -->
                                    <x-form-group-input
                                        name="status_name"
                                        label="{{ __('Текущий статус') }}"
                                        value="{{ Auth::user()->status->status_name ?? 'Не указано' }}"
                                        readonly
                                    />
                                    <!-- Дата статуса -->
                                    <x-form-group-input
                                        name="status_at"
                                        label="{{ __('Дата статуса') }}"
                                        value="{{ Auth::user()->status_at_input }}" readonly=""
                                        type="date"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('Обновить')}}</button>
                        <!-- Ошибки -->
                        <x-errors/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-section>
