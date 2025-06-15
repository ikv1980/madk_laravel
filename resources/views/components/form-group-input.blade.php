@props([
    'name',
    'label' => null,
    'value' => '',
    'type' => 'text',
    'placeholder' => __('Введите значение'),
    'labelCol' => '2',
    'inputCol' => '10',
    'attributes' => []
])

<div class="form-group row">
    @if($label)
        <label class="col-sm-{{ $labelCol }} col-form-label">{{ $label }}</label>
    @endif
    <div class="col-sm-{{ $inputCol }}">
        <input
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            type="{{ $type }}"
            class="form-control"
            placeholder="{{ $placeholder }}"
        @foreach($attributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->merge([]) }}
        >
        @error($name)
        <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
