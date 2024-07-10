<div
    class="flex overflow-hidden bg-white border divide-x rounded-lg rtl:flex-row-reverse"
>
    @foreach($options as $icon => $value)
        <button
            x-on:click="{{$click}}('{{$value}}')"
            :class="{{ $name }} === '{{ $value }}' ? 'text-gray-800 bg-gray-300' : 'text-gray-600'"
            class="px-2 py-2 font-medium transition-colors duration-200 sm:px-6 hover:bg-gray-100"
        >
            @svg('heroicon-' . $icon, 'w-4 h-4 sm:w-5 sm:h-5')
        </button>
    @endforeach
</div>
