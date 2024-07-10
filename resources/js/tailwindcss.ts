
export function tailwindcssApplyTheme(theme: string|null): string {
    const root = document.documentElement;

    if (theme === 'dark') {
        root.classList.add('dark');
        root.classList.remove('light');

        return 'dark'
    } else if (theme === 'light') {
        root.classList.add('light');
        root.classList.remove('dark');

        return 'light'
    } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            root.classList.add('dark');
            root.classList.remove('light');

            return 'dark'
        } else {
            root.classList.add('light');
            root.classList.remove('dark');

            return 'light'
        }
    }
}
