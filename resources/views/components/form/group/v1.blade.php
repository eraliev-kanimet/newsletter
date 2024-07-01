<div {{$attributes->only('class')}}>
    <label
        for="{{$name}}"
        class="block text-sm text-gray-800 dark:text-gray-200"
    >{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $type != 'password' ? old($name) : '' }}"
        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
    />
    @error($name)
        <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
    @enderror
</div>
