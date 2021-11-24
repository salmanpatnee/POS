@props(['name'])

@error($name)
    <small class="text-danger d-block w-100">{{ $message }}</small>
@enderror
