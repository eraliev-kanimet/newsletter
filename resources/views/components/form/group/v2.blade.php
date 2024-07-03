@php
    $inputClasses = 'block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40';

    if ($disabled) {
        $inputClasses .= ' bg-gray-50 cursor-not-allowed placeholder-gray-400/70 dark:placeholder-gray-500 dark:bg-gray-900';
    }

    if ($errors->has($name)) {
        $inputClasses .= ' border border-red-400 dark:border-red-400';
    }
@endphp

<div {{ $attributes->only('class') }}>
    <div class="flex items-center justify-between">
        <label
            for="{{$name}}"
            class="block text-sm text-gray-800 dark:text-gray-200"
        >{{ $label }}</label>
        <a href="{{$url}}" class="text-xs text-gray-600 dark:text-gray-400 hover:underline">{{$urlLabel}}</a>
    </div>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $value }}"
        class="{{ $inputClasses }}"
        @disabled($disabled)
    />
    @error($name)
    <div class="text-red-400 mt-1 text-sm">{{ $message }}</div>
    @enderror
</div>
