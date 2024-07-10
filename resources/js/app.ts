import Alpine from 'alpinejs'

import {tailwindcssApplyTheme} from "./tailwindcss";

document.addEventListener('DOMContentLoaded', () => {
    tailwindcssApplyTheme()
});

Alpine.start()
