@props(['label', 'readonly' => '', 'placeholder' => '', 'id', 'type' => 'text', 'name', 'required', 'value'])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<input type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{ $name }}" class="input" id="{{ $id }}" value="{{ $value }}" {{ $required }} {{ $readonly }} />
@if ($errors->get($name))
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2']) }}>
        @foreach ((array) $errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
