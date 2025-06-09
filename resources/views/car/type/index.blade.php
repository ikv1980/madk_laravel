@extends('layouts.main')

@section('content')

    @include('components.title')

    <x-section>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('car-types.create') }}" class="btn btn-primary">{{__('Добавить')}}</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <!-- Таблица с данными -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">ID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Наименование
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($items as $item)

                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->id }}</td>
                                        <td>{{ $item->type_name }}</td>
                                    </tr>

                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th rowspan="1" colspan="1">Наименование</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Пагинация -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                    {{__('Показано с')}} {{ $items->firstItem() }} {{__('по')}} {{ $items->lastItem() }} {{__('из')}} {{ $items->total() }} {{__('записей')}}
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="example2_previous">
                                        <li class="paginate_button page-item previous {{ $items->onFirstPage() ? 'disabled' : '' }}">
                                            <a href="{{ $items->previousPageUrl() }}" class="page-link"> {{__('Назад')}}</a></li>

                                        @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                                            <li class="paginate_button page-item {{ $items->currentPage() == $page ? 'active' : '' }}">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        <li class="paginate_button page-item next {{ !$items->hasMorePages() ? 'disabled' : '' }}">
                                            <a href="{{ $items->nextPageUrl() }}" class="page-link"> {{__('Вперед')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </x-section>

@endsection
