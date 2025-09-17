let mix = require('laravel-mix');

/**
 * Compile React + CSS
 * - app.jsx -> public/js/app.js
 * - app.css -> public/css/app.css
 */
mix.react('resources/js/app.jsx', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [])
   .sourceMaps();

/** Optional: versi cache-busting untuk production */
// if (mix.inProduction()) {
//   mix.version();
// }
