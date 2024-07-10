<header class="fixed left-1/2 -translate-x-1/2 container mx-auto flex gap-5 justify-end py-3">
    <a
        href="{{ route('set.locale', $alterLocale) }}"
        class="btn-v2"
    >
        {{ config("app.locales.$alterLocale") }}
    </a>
    <x-ui.select-button.v1 name="theme" click="setTheme" :options="['o-sun' => 'light', 'o-moon' => 'dark']"/>
</header>
