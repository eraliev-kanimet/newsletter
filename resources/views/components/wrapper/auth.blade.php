<screen class="h-screen flex justify-center items-center">
    <div class="w-full max-w-md p-5 m-auto mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex justify-center mx-auto">
            <h1 class="dark-gray-700 dark:text-white text-2xl">{{ $title }}</h1>
        </div>

        {{ $slot }}
    </div>
</screen>
