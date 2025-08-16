@props(['label', 'name', 'value', 'placeholder' => '', 'type'=> 'text', 'class', 'readonly' => false, 'uppercase' => false , 'wraperattribute' => true])

<div
    @if ($wraperattribute)
        class="col-12 col-xl-12 mb-3 px-4"
    @endif
    >
  <label for="defaultFormControlInput" class="form-label">{{ $label }}</label>
  <input
    {{ $attributes }}
    class="form-control @error($name)
      is-invalid
    @enderror"
    id="floatingInput{{ $name }}"
    type={{ $type }}
    placeholder="{{ $placeholder }}"
    value="{{ old($name, $value ?? null) }}"
    name="{{ $name }}"
    {{ $readonly ? 'readonly' : '' }}
    style="{{ $uppercase ? 'text-transform: uppercase' : '' }}"
  />

  @error($name)
    <div id="floatingInput{{ $name }}Help" class="form-text text-danger">
      {{ $message }}
    </div>
  @enderror
</div>
