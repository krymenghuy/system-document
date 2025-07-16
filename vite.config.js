import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
<<<<<<< HEAD
    build: {
        outDir: 'public/build'
    }
=======
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
});
