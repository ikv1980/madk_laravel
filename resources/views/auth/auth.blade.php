@extends('layouts.empty')

@section('content')
    <div class="login-box mx-auto" style="width: 800px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-left">
                {{__('Начальная форма входа на сайт "Автосалон"')}}
            </div>
            @if($errors->any())
                <div class="card-body px-3 py-0">
                    <!--Блок ошибок-->
                    <x-errors/>
                </div>
            @endif

            <!--Карточка регистрации/авторизации-->
            <div class="card-body">
                <dl class="row">
                    <!--Левая часть-->
                    <dt class="col-sm-3 align-items-center d-flex bg-dark">
                        <img
                            src="{{ asset('https://tomware.cc/uploads/monthly_2025_03/Logo.png.9e5dec2d36917658b34a0696139bdb35.png') }}"
                            alt="Логотип" style="max-width: 100px; margin-right: 10px;">
                    </dt>
                    <!--Правая часть-->
                    <dd class="col-sm-9">
                        <div class="card">
                            <div class="card card-info card-tabs">
                                <!--Вкладки меню-->
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="auth" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                               href="#custom-tabs-one-home" role="tab"
                                               aria-controls="custom-tabs-one-home"
                                               aria-selected="true">{{__('Авторизация')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="register" data-toggle="pill"
                                               href="#custom-tabs-one-profile"
                                               role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">{{__('Регистрация')}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!--Тело вкладок-->
                                <div class="card-body">
                                    <div class="tab-content" id="authContent">
                                        <!-- Вкладка Авторизация -->
                                        <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel"
                                             aria-labelledby="custom-tabs-one-home-tab">
                                            <div class="tab-pane fade show active" id="tab-login">
                                                <form action="{{ route('auth.authenticate') }}" method="post">
                                                    @csrf
                                                    <!--Логин-->
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="login" class="form-control"
                                                               placeholder="{{__('Логин')}}" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
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
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        {{__('Авторизоваться')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Вкладка Регистрация -->
                                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                             aria-labelledby="register">
                                            <form action="{{ route('auth.store') }}" method="post">
                                                @csrf
                                                <!--Имя-->
                                                <div class="input-group mb-3">
                                                    <input type="text" name="firstname" class="form-control"
                                                           placeholder="{{__('Имя')}}" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-address-card"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Фамилия-->
                                                <div class="input-group mb-3">
                                                    <input type="text" name="surname" class="form-control"
                                                           placeholder="{{__('Фамилия')}}" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-address-card"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Логин-->
                                                <div class="input-group mb-3">
                                                    <input type="text" name="login" class="form-control"
                                                           placeholder="{{__('Логин')}}" required>
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
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{__('Зарегистрироваться')}}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

@stop
