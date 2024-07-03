@extends('layouts.default')

@section('main')
    <x-wrapper.auth :title="__('common.registration')">
        <p class="mt-4 font-light text-center text-gray-400">
            {{ __('pages.register.3') }}
            <a
                href="{{ route('auth.register.page') }}"
                class="font-medium text-gray-700 dark:text-gray-200 hover:underline"
            >{{ mb_ucfirst(__('common.click_on_it')) }}</a>
            {{ __('pages.register.4') }}
        </p>
    </x-wrapper.auth>
@endsection
