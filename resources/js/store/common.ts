import {tailwindcssApplyTheme} from "../tailwindcss";

interface Common {
    init: () => void;
    theme: string;
    setTheme: (theme: string) => void;
}

const common = (): Common => ({
    init() {
        this.theme = tailwindcssApplyTheme(localStorage.getItem('theme') ?? null)
    },

    theme: '',

    setTheme(theme: string) {
        localStorage.setItem('theme', theme);

        this.theme = tailwindcssApplyTheme(theme)
    }
})

export default common
