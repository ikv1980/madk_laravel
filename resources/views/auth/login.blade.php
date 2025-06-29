@extends('layouts.empty')

@section('content')
    <div class="login-box mx-auto" style="width: 600px;">
        <div class="card card-info">
            <div class="card-header text-left">
                <div class="d-flex justify-content-between align-items-center">
                    {{__('"Автосалон". Авторизация пользователя')}}
                    <div class="text-yellow">
                        <i class="fas fa-angle-left"></i>
                        <a href="{{ route('register') }}">{{__('Регистрация')}}</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
            <!--Карточка авторизации-->
            <div class="card-body">
                <div class="tab-content" id="authContent">
                    <div class="tab-pane fade show active" id="tab-login">
                        <form action="{{ route('auth.authenticate') }}" method="post">
                            @csrf
                            <!--Логин-->
                            <div class="input-group mb-3">
                                <input type="text" name="login" class="form-control"
                                       placeholder="{{__('Логин')}}"
                                       value="{{ old('login') }}" required>
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
