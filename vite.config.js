import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from "path"

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            "@": path.resolve(__dirname, "resources"),
            "@js": path.resolve(__dirname, "resources/js"),

            assets: path.resolve(__dirname, "resources/js/assets"),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~sweetalert2': path.resolve(__dirname, 'node_modules/sweetalert2'),
            // '~vue2-datepicker': path.resolve(__dirname, 'node_modules/vue3-datepicker'),
            '~vueform': path.resolve(__dirname, 'node_modules/@vueform'),
            '~vue-multiselect': path.resolve(__dirname, 'node_modules/vue-multiselect'),
            '~vue3-form-wizard': path.resolve(__dirname, 'node_modules/vue3-form-wizard'),
            '~@fullcalendar': path.resolve(__dirname, 'node_modules/@fullcalendar'),
        },
    },
});
