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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.sass('resources/scss/app.scss', 'public/css');

mix.sass('resources/scss/gallery.scss', 'public/css')

mix.sass('resources/scss/profile.scss', 'public/css');

mix.sass('resources/scss/index.scss', 'public/css');

mix.sass('resources/scss/editform.scss', 'public/css')