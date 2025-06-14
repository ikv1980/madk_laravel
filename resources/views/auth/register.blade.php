@extends('layouts.empty')

@section('content')
    <div class="login-box mx-auto" style="width: 600px;">
        <div class="card card-info">
            <div class="card-header text-left">
                <div class="d-flex justify-content-between align-items-center">
                    {{__('"Автосалон". Регистрация пользователя')}}
                    <div class="text-yellow">
                        <i class="fas fa-angle-left"></i>
                        <a href="{{ route('login') }}" >{{__('Авторизация')}}</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
            <!--Карточка регистрации-->
            <div class="card-body">
                <div class="tab-content" id="authContent">
                    <div class="tab-pane fade show active" id="tab-login">
                        <form action="{{ route('auth.store') }}" method="post">
                            @csrf
                            <!--Имя-->
                            <div class="input-group mb-3">
                                <input type="text" name="firstname" class="form-control"
                                       placeholder="{{__('Имя')}}"
                                       value="{{ old('firstname') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                            <!--Фамилия-->
                            <div class="input-group mb-3">
                                <input type="text" name="surname" class="form-control"
                                       placeholder="{{__('Фамилия')}}"
                                       value="{{ old('surname') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                            <!--Логин-->
                            <div class="input-group mb-3">
                                <input type="text" name="login" class="form-control"
                                       placeholder="{{__('Логин')}}"
                                       value="{{ old('login') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-alt"></span>
                                    </div>
                                </div>
                            </div>
                            <!--Пароль-->
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{__('Пароль')}}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3 text-dark">
                                <x-checkbox name="agreement" value="1">
                                    {{__('Согласие на обработку пользовательских данных')}}
                                </x-checkbox>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                {{__('Зарегистрироваться')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="card-body px-3 py-0">
                    <!--Блок ошибок-->
                    <x-errors/>
                </div>
            @endif
        </div>
    </div>
@stop
