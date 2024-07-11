<div class="flex items-center justify-between mt-7">
    <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/5"></span>

    <p class="text-xs text-center text-gray-500 uppercase dark:text-gray-400">{{ __($title) }}</p>

    <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/5"></span>
</div>

<div class="flex items-center mt-6 -mx-2">
    <a
        href="{{ route('auth.socialite.redirect', 'google') }}"
        class="flex items-center justify-center w-full px-6 py-2 mx-2 text-sm font-medium text-white transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:bg-blue-400 focus:outline-none"
    >
        @include('icons.google')
        <span class="hidden mx-2 sm:inline">{{ __($google) }}</span>
    </a>
    <a
        href="{{ route('auth.socialite.redirect', 'github') }}"
        class="p-2 mx-2 text-sm font-medium text-gray-500 transition-colors duration-300 transform bg-gray-100 rounded-lg hover:bg-gray-200"
    >
        @include('icons.github')
    </a>
</div>
