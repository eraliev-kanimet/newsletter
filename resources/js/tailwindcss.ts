
export function tailwindcssApplyTheme() {
    const theme = localStorage.getItem('theme');
    const root = document.documentElement;
    console.log(root)
    if (theme === 'dark') {
        root.classList.add('dark');
        root.classList.remove('light');
    } else if (theme === 'light') {
        root.classList.add('light');
        root.classList.remove('dark');
    } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            root.classList.add('dark');
            root.classList.remove('light');
        } else {
            root.classList.add('light');
            root.classList.remove('dark');
        }
    }
}
