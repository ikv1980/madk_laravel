{{--
Компонент вывода всех ошибок по списку.
Установлен как тег <x-errors/> в методах  create (update)
--}}
@if($errors->any())
    <div class="alert callout callout-danger alert-dismissible py-2 mt-3 text-danger">
        <h5><i class="icon fas fa-exclamation-triangle"></i>{{__('Внимание')}}</h5>
        @foreach($errors->all() as $message)
            <p class="mb-0">
                {{$message}}
            </p>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
