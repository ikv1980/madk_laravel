{{--
Компонент вывода информационного сообщения на странице.
Установлен в main.blade.php как @include('includes.alert')
--}}
@if(session()->has('alert') && session()->has('alert_style'))
    @php
        $text = session()->pull('alert');
        $style = session()->pull('alert_style');
    @endphp
    <div class="alert {{ $style }} my-0 py-2 text-right">
        {{ $text }}
    </div>
@endif
