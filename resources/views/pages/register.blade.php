@extends('layouts.default')

@section('main')
    <screen class="h-screen flex justify-center items-center">
        <div class="w-full max-w-sm p-5 m-auto mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex justify-center mx-auto">
                <h1 class="text-white text-2xl">{{ __('common.registration') }}</h1>
            </div>

            <form class="mt-6" method="post" action="{{ route('auth.register.action') }}">
                @csrf

                <x-form.group.v1
                    name="name"
                    :label="__('common.name')"
                />

                <x-form.group.v1
                    name="email"
                    :label="__('common.email')"
                    class="mt-4"
                    type="email"
                />

                <x-form.group.v1
                    name="password"
                    :label="__('common.password')"
                    class="mt-4"
                    type="password"
                />

                <x-form.group.v1
                    name="password_confirmation"
                    :label="__('common.password_confirmation')"
                    class="mt-4"
                    type="password"
                />

                <div class="mt-4">
                    <button class="btn-v1">{{ __('common.registration') }}</button>
                </div>
            </form>

            <p class="mt-8 text-xs font-light text-center text-gray-400">
                {{ __('pages.register.1') }}
                <a
                    href="#"
                    class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
                >{{ __('pages.register.2') }}</a>
            </p>
        </div>
    </screen>
@endsection
