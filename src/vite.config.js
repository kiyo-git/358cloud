import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl'

export default defineConfig({
    plugins: [
        basicSsl(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin/style.css',
                'resources/css/payment/common.css',
                'resources/js/app.js',
                'resources/js/admin/common.js',
                'resources/js/admin/adminUser.js',
                'resources/js/admin/transferUser.js',
                'resources/js/admin/payment.js',
                'resources/js/payment/mdkToken.js',
                'resources/js/user/zipSearch.js',
                'resources/js/user/validation.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: true,
        host: true,
    },
});
