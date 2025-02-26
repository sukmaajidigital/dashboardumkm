@props(['label', 'id', 'options' => [], 'name', 'required', 'selected' => null])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<select class="select" id="{{ $id }}" name="{{ $name }}" {{ $required }}>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
@if ($errors->get($name))
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2']) }}>
        @foreach ((array) $errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
