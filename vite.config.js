import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import FastGlob from 'fast-glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                ...FastGlob.sync(['resources/css/**/*.css','resources/css/**/*.js','resources/backend/**/*.*','resources/frontend/**/*.*'])
            ],
            refresh: true,
        }),
    ],
    server:{
        host:'0.0.0.0',
        hmr:{
            host:'192.168.1.73'
        },
    },

});
