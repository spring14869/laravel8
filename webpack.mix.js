const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.setPublicPath('public/assets'); //套件基本路徑，避免compiling路徑四散
mix.setResourceRoot('../');

mix.js('resources/js/app.js', 'public/assets/js')
    .sourceMaps(false, 'source-map')
    .postCss('resources/css/app.css', 'public/assets/css', [
        //
    ])
    .postCss('resources/css/dashboard.css', 'public/assets/css')
    .copy('node_modules/font-awesome/fonts/', 'public/assets/fonts');
