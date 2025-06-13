{{--уникальный id для checkbox--}}
@php
    use Illuminate\Support\Str;
@endphp

@php($id = Str::uuid())

<div class="form-check">
    <input {{ $attributes->class([
        'form-check-input'
    ])->merge([
        'value' => 1,
        'checked' => !! old($attributes->get('name'))
    ]) }} type="checkbox" id={{ $id }} />
    <label class="form-check-label" for={{ $id }}>
        {{ $slot }}
    </label>
</div>

