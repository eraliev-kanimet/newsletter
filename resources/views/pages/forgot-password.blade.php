@extends('layouts.default')

@section('main')
    <x-wrapper.auth
        :title="__('common.forgot_password')"
    >
        @if(isset($success))
            <div class="text-center text-white mt-4">
                {{__('pages.forgot_password.3')}}
            </div>
        @else
            <form class="mt-4" method="post" action="{{ route('auth.forgot-password.action') }}">
                @csrf

                <x-form.group.v1
                    name="email"
                    :label="__('common.email')"
                    class="mt-4"
                    type="email"
                />

                <p class="text-white text-center text-xs mt-4">
                    {{ __('pages.forgot_password.2') }}
                </p>

                <div class="mt-2">
                    <button class="btn-v1">{{ __('common.submit') }}</button>
                </div>
            </form>
        @endif
    </x-wrapper.auth>
@endsection
