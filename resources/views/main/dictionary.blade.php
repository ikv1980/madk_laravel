@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route($data['route'].'.create') }}" class="btn btn-primary">{{__('Добавить')}}</a>
                </div>
                <!-- Вызов общего компонента -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <!-- Таблица с данными -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1_wrapper"
                                       class="table table-bordered"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr>
                                        <th style="width: 75px"></th>
                                        @foreach ($data['headers'] as $header)
                                            <th>{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($data['items']) > 0)
                                        @foreach ($data['items'] as $index => $item)
                                            <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                                                <td>
                                                    <a href="{{ route($data['route'].'.show', $item->id) }}" class="text-primary mr-2">
                                                        <i class="nav-icon far fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route($data['route'].'.edit', $item->id) }}" class="text-success">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                @foreach ($data['columns'] as $column)
                                                    <td>
                                                        {{ data_get($item, $column) }}
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ count($data['headers']) }}" class="text-center">
                                                {{ __('Отсутствуют данные') }}
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>

                                    <tfoot>
                                    <th style="width: 40px"></th>
                                    @foreach ($data['headers'] as $header)
                                        <th>{{ $header }}</th>
                                    @endforeach
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Пагинация -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                    {{__('Показано с')}} {{ $data['items']->firstItem() }} {{__('по')}} {{ $data['items']->lastItem() }} {{__('из')}} {{ $data['items']->total() }} {{__('записей')}}
                                </div>
                            </div>
                            @if($data['items']->lastPage() != 1)
                                <div class="col-sm-12 col-md-7 d-flex justify-content-end">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="example2_previous">
                                            <li class="paginate_button page-item previous {{ $data['items']->onFirstPage() ? 'disabled' : '' }}">
                                                <a href="{{ $data['items']->previousPageUrl() }}"
                                                   class="page-link"> {{__('Назад')}}</a></li>

                                            @foreach ($data['items']->getUrlRange(1, $data['items']->lastPage()) as $page => $url)
                                                <li class="paginate_button page-item {{ $data['items']->currentPage() == $page ? 'active' : '' }}">
                                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <li class="paginate_button page-item next {{ !$data['items']->hasMorePages() ? 'disabled' : '' }}">
                                                <a href="{{ $data['items']->nextPageUrl() }}"
                                                   class="page-link"> {{__('Вперед')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-section>

@endsection

