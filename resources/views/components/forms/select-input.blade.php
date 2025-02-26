@props(['label', 'id', 'options' => [], 'name'])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<select class="select" id="{{ $id }}" name="{{ $name }}">
    @foreach ($options as $option)
        <option>{{ $option }}</option>
    @endforeach
</select>
