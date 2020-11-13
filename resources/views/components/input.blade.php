@props(['type' => 'text'])
<div>
    <input {{ $attributes }} type="{{ $type }}" class="form-input text-gray-600 w-full @error($attributes->wire('model')->value()) border-red-400 @enderror">
    @error($attributes->wire('model')->value())
        <div class="mt-2 text-red-500 text-xs">{{ $message }}</div>
    @enderror
</div>