// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'


export default defineConfig({
    plugins: [
        vue({
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => ['ShowMovies'].includes(tag),
                }
            }
        }),
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
