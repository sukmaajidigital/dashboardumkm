@props(['label', 'readonly' => '', 'onchange' => '', 'jsvalue' => '', 'optionname' => '', 'jscolname1' => '', 'jscolname2' => '', 'id', 'options' => [], 'name', 'required', 'selected' => null])

<label class="label label-text" for="{{ $id }}">
    {{ $label }}
</label>
<select class="select ltr:text-left " style="padding-right: 2.5rem !important; background-position: right 0.75rem center !important;" id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }} onchange="{{ $onchange }}" dir="ltr">
    @if (is_array($options) && !is_object(reset($options)))
        {{-- Jika options adalah array asosiatif --}}
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    @else
        {{-- Jika options adalah koleksi Eloquent atau array objek --}}
        @foreach ($options as $key)
            <option value="{{ $key->id }}" @if ($jsvalue) data-select="{{ $key->$jscolname2 }}" @endif {{ $selected == $key->id ? 'selected' : '' }}>
                {{ $key->$optionname }}
            </option>
        @endforeach
    @endif
</select>
@if ($errors->get($name))
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2']) }}>
        @foreach ((array) $errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
