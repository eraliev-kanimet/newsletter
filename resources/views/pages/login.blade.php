@extends('layouts.default')

@section('main')
    <screen class="h-screen flex justify-center items-center">
        <div class="w-full max-w-sm p-5 m-auto mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex justify-center mx-auto">
                <h1 class="text-white text-2xl">{{ __('common.login') }}</h1>
            </div>

            <form class="mt-6" method="post" action="{{ route('auth.login.action') }}">
                @csrf

                <x-form.group.v1
                    name="email"
                    :label="__('common.email')"
                    class="mt-4"
                    type="email"
                />

                @if(isset($error))
                    <div class="text-red-600 mt-2 text-sm">{{ $error }}</div>
                @endif()

                <x-form.group.v2
                    name="password"
                    :label="__('common.password')"
                    class="mt-4"
                    type="password"
                    url="/"
                    :url-label="__('common.forgot_password') . '?'"
                />

                <div class="mt-4">
                    <button class="btn-v1">{{ __('common.login') }}</button>
                </div>
            </form>

            <p class="mt-8 text-xs font-light text-center text-gray-400">
                {{ __('pages.login.1') }}
                <a
                    href="#"
                    class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
                >{{ __('pages.login.2') }}</a>
            </p>
        </div>
    </screen>
@endsection
