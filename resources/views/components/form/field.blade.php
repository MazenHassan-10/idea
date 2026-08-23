@props(['label' , 'name' , 'type'=>'text' , 'value'=>''])

<div class="space-y-2">
    @if($label)
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')

        <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="textarea"
        {{ $attributes }}>{{ old($name, $value)  }}</textarea>
    @else

    <input 
        type="{{$type}}"
        name="{{$name}}"
        id="{{$name}}"
        value="{{ old($name , $value )}}"
        class="input"
        {{ $attributes }}
        >

    @endif
</div>

@error($name)
    <p class="error">{{ $message }}</p>
@enderror
