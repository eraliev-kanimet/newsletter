@extends('layouts.auth')

@section('main')
    <x-wrapper.auth
        :title="__('common.login')"
    >
        <form class="mt-4" method="post" action="{{ route('auth.login.action') }}">
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
                :url="route('auth.forgot-password.page')"
                :url-label="__('common.forgot_password') . '?'"
            />

            <div class="mt-4">
                <button class="btn-v1">{{ __('common.login') }}</button>
            </div>
        </form>

        <p class="mt-7 text-xs font-light text-center text-gray-600 dark:text-gray-300">
            {{ __('pages.login.1') }}
            <a
                href="{{ route('auth.register.page') }}"
                class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
            >{{ __('pages.login.2') }}</a>
        </p>
    </x-wrapper.auth>
@endsection
