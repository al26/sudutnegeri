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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copyDirectory('resources/assets/css/', 'public/css', false)
   .copyDirectory('node_modules/summernote/dist/font/', 'public/css/font', false)
   .options({processCssUrls: false})
   .styles(['node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'], 'public/css/dataTables-bs4.css')
   .styles(['node_modules/summernote/dist/summernote-bs4.css'], 'public/css/summernote-bs4.css');
