@props(['label', 'readonly' => '', 'placeholder' => '', 'id', 'name', 'required', 'value'])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<textarea class="input textarea" placeholder="{{ $placeholder }}" id="{{ $id }}" name="{{ $name }}" {{ $required }} {{ $readonly }}>{{ $value }}</textarea>
@if ($errors->get($name))
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2']) }}>
        @foreach ((array) $errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
