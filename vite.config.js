import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/admin-orders-echo.js', 'resources/js/customer-order-status-echo.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
