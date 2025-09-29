let mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js').react()
   .postCss('resources/css/app.css', 'public/css', [])
   .sourceMaps();

/** Optional: cache busting untuk production */
if (mix.inProduction()) {
    mix.version();
}
