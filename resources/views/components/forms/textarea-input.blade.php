@props(['label', 'placeholder' => '', 'id', 'name'])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<textarea class="input textarea" placeholder="{{ $placeholder }}" id="{{ $id }}" name="{{ $name }}"></textarea>
