let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',  
    'resources/assets/js/app.js'
], 'public/js/app.js').autoload({
    jQuery: 'jquery',
    $: 'jquery',
    jquery: 'jquery'
})
   .sass('resources/assets/sass/app.scss', 'public/css');

   mix.copy('node_modules/axios/dist/axios.js', 'public/js/axios.js');
   mix.copy('node_modules/plyr/dist/', 'public/plyr/');