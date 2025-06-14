{{--Главная страница сайта--}}

@extends('layouts.main')

@section('content')

    @include('components.title')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Заказы -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Заказы</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее...<i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- Клиенты -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Клиенты</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее...<i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- Пользователи -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Пользователи</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее...<i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
            </div>
            <!-- Данные пользователя -->
            {{--<x-user-card></x-user-card>--}}
        </div>
    </section>
    <!-- /.content -->
@endsection
