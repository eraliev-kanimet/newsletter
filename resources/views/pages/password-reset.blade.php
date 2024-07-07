@extends('layouts.default')

@section('main')
    <x-wrapper.auth
        :title="__('common.password_reset')"
    >
        @if($resetToken->isExpired())
            <p class="mt-4 font-light text-center text-gray-400">
                {{ __('pages.password_reset.2') }}
                <a
                    href="{{ route('auth.forgot-password.page') }}"
                    class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
                >{{ __('common.click_on_it') }}.</a>
            </p>
        @else
            <form class="mt-4" method="post" action="{{ route('auth.password-reset.action') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $resetToken->token }}">

                <x-form.group.v1
                    name="email"
                    :label="__('common.email')"
                    class="mt-4"
                    type="email"
                    :value="$resetToken->email"
                    :disabled="true"
                />

                @if(isset($error))
                    <div class="text-red-600 mt-2 text-sm">{{ $error }}</div>
                @endif()

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
                    <button class="btn-v1">{{ __('common.submit') }}</button>
                </div>
            </form>
        @endif
    </x-wrapper.auth>
@endsection


