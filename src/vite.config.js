import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: [
                'routes/**',
                'resources/views/**',
                'resources/js/Pages/**'
            ],
        }),
        react(),
    ],
    server: {
        watch: {
            usePolling: true,
        },
        host: true, // Here
        strictPort: true,
        port: 8000,
    },
});

