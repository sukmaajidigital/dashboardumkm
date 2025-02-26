@props(['label', 'placeholder' => '', 'id', 'type' => 'text', 'name'])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<input type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{ $name }}" class="input" id="{{ $id }}" />
