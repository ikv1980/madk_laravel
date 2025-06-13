@props(['title' => 'Информационное окно', 'color'=>'primary', 'id'=>'id_modal'])

{{--
Вызов модального окна через кнопку
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_id_modal">
    {{__("Войти")}}
</button>
<x-modal-window color="primary" title="Окно авторизации" id="new_id_modal"></x-modal-window>
--}}

<!-- Модальное окно для авторизации -->
<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2 text-white bg-{{$color}}">
                <h5 class="modal-title" id="authModalLabel">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-1">
                <!-- Данные для модального окна -->
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
