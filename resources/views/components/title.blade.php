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
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
