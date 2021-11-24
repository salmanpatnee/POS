@props(['type' => 'text', 'name', 'placeholder' => ''])
<div class="form-group">
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"
        wire:model="{{ $name }}" autocomplete="off" placeholder="{{ $placeholder }}">
    <x-form.error name="{{ $name }}" />
</div>
