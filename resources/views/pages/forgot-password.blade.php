@extends('layouts.default')

@section('main')
    <x-wrapper.auth
        :title="__('common.forgot_password')"
    >
        <form class="mt-4" method="post" action="{{ route('auth.forgot-password.action') }}">
            @csrf

            <x-form.group.v1
                name="email"
                :label="__('common.email')"
                class="mt-4"
                type="email"
            />

            <p class="font-light text-gray-600 dark:text-gray-300 text-center text-xs mt-4">
                {{ __('pages.forgot_password.2') }}
            </p>

            <div class="mt-2">
                <button class="btn-v1">{{ __('common.submit') }}</button>
            </div>
        </form>
    </x-wrapper.auth>
@endsection
