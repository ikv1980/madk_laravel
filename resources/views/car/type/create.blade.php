@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
{{--                    <a href="{{ route($data['route'].'.create') }}" class="btn btn-primary">{{__('Добавить')}}</a>--}}
                </div>
                <!-- Вызов общего компонента -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection

