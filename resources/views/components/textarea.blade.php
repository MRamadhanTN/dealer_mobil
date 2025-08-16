@props(['label', 'name', 'value', 'placeholder' => '', 'class', 'readonly' => false, 'uppercase' => false , 'wraperattribute' => true, 'row' => 7])

<div
  @if ($wraperattribute)
    class="col-12 col-xl-8 mb-3">
  @endif
  <label for="defaultFormControlInput" class="form-label">{{ $label }}</label>
  <textarea
    {{ $attributes }}
    class="form-control @error($name)
      is-invalid
    @enderror mt-2"
    id="floatingInput{{ $name }}"
    placeholder="{{ $placeholder }}"
    name="{{ $name }}"
    {{ $readonly ? 'readonly' : '' }}
    style="{{ $uppercase ? 'text-transform: uppercase' : '' }}"
    rows="{{ $row }}"
  >{{ old($name, $value ?? null) }}</textarea>

  @error($name)
    <div id="floatingInput{{ $name }}Help" class="form-text text-danger">
      {{ $message }}
    </div>
  @enderror
</div>
