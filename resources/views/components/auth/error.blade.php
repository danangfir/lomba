@props(['field'])

@error($field)
    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
@enderror
