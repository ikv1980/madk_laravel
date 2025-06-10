<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            @isset($data['title'])
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['title']}}</h1>
                </div>
            @endisset
            <!-- Элемент справа -->
            <div class="col-sm-6 text-right">
                <a href="javascript:history.back()" class="ico btn-back">
                    <i class="fas fa-arrow-right"></i>
                    {{__('Назад')}}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
