import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig, lazyPlugins } from 'vite-plus';

export default defineConfig({
    plugins: lazyPlugins(() => [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/passkeys.js',
                'resources/css/site.css',
                'resources/js/site.js',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    alias: 'app',
                    weights: [400, 500, 600],
                }),
                // Public website: a single family keeps font payload small.
                bunny('Manrope', {
                    alias: 'site',
                    weights: [400, 500, 600, 700],
                }),
            ],
        }),
        tailwindcss(),
    ]),
    server: {
        cors: true,
        watch: {
            ignored: [
                '**/.agents/**',
                '**/.claude/**',
                '**/.cursor/**',
                '**/.junie/**',
                '**/storage/framework/views/**',
                '**/vendor/**',
            ],
        },
    },
});
