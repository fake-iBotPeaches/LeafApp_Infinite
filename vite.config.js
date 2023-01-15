import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import purge from '@erbelion/vite-plugin-laravel-purgecss';
import manifestSRI from 'vite-plugin-manifest-sri';

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
        ]),
        purge({
            templates: ['blade', 'vue'],
            safelist: {
                greedy: [
                    /orange/,
                    /purple/,
                    /unranked/
                ],
                deep: [
                    /has-tooltip-info/,
                    /has-text-info/,
                    /has-text-primary/,
                ]
            },
        }),
        manifestSRI(),
    ],
});