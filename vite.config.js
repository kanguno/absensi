import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
  //    server: {
  //   watch: {
  //     usePolling: true,
  //   },
  // },

  server: {
    host: '0.0.0.0',
    port: 5173, // pastikan sesuai
    strictPort: true,
  },

});
