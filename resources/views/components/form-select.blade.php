@props([
	'label',
	'name',
	'value',
	'options',
	'default',
	'disabled',
	'readonly' => false,
	'style' => '',
	'custom',
	'wraperattribute' => true,
]) {{-- options format: [id => 'name'] (created using pluck) --}}


<div @if ($wraperattribute) class="col-12 col-xl-8 mb-3" @endif style="{{ $style }}" id="div_{{ $name }}">
    <label for="select{{ $name }}">{{ $label }}</label>
    <select
		style="border: 1px solid #c9c9c9;"
		class=" form-control	@error($name)	is-invalid @enderror"
		id	 ="select_{{ $name }}"
		name ={{ $name }}
		{{ $attributes }}
		{{ $readonly ? 'readonly' : '' }}
		{{ $disabled ?? '' }}
	>
		@isset($default)
    	    <option value="{{ $default['value'] }}" class="d-none" selected>{{ $default['label'] }}</option>
		@endisset
        {{-- @if (isset($custom))
            @foreach ($options as $option)
    		<option
    			value="{{ $option[$custom['id']] }}"
    			@if((string)$option[$custom['id']] === (string)old($name, $value ?? null))
    				selected
    			@endif
    		>
            @foreach ($custom['name'] as $key => $param)
                @if (isset($key))
                    {{ $option[$param] }}
                @else
                    {{ $key }} {{ $option[$param] }}
                @endif
            @endforeach
    		</option>
            @endforeach
        @else --}}
    		@foreach ($options as $optionId => $optionName)
    		<option
    			value="{{ $optionId }}"
    			@if((string)$optionId === (string)old($name, $value ?? null))
    				selected
    			@endif
    		>
            {{ $optionName }}
    		</option>
            @endforeach
        {{-- @endif --}}
    </select>

    <small class="form-text text-muted">Pilih salah satu.</small>
	@error($name)
		<span class="invalid-feedback">
			{{ $message }}
		</span>
	@enderror
</div>
