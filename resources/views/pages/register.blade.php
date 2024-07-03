@extends('layouts.default')

@section('main')
    <x-wrapper.auth :title="__('common.registration')">
        @if($success)
            <p class="mt-4 font-light text-center text-gray-400">{{ __('pages.register.3') }}</p>
        @else
            <form class="mt-6" method="post" action="{{ route('auth.register.order') }}">
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
                    href="{{ route('auth.login.page') }}"
                    class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
                >{{ __('pages.register.2') }}</a>
            </p>
        @endif
    </x-wrapper.auth>
@endsection

