@php
    $locale = config('app.locale');

    $alterLocale = $locale == 'en' ? 'ru' : 'en'
@endphp

<!doctype html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Newsletter' }}</title>
    @vite(['resources/js/app.ts', 'resources/css/app.css', 'resources/css/components/ui.css'])
</head>
<body>
<main class="min-h-screen">
    @yield('main')
</main>
</body>
</html>
