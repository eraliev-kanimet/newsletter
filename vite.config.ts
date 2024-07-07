import {defineConfig} from 'vite';

import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/components/ui.css',
                'resources/js/app.ts',
                'resources/app/main.ts'
            ],
            refresh: true,
        }),
        vue(),
    ],
});
