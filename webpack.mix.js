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
    .js('resources/assets/js/main.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/main.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css');

mix.scripts([
    'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/jquery-easing/jquery.easing.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/chart.js/Chart.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/datatables/jquery.dataTables.js',
    'node_modules/startbootstrap-sb-admin/vendor/datatables/dataTables.bootstrap4.js',
], 'public/assets/js/admin-vendor.js');

mix.scripts([
    'node_modules/startbootstrap-sb-admin/js/sb-admin.min.js',
    'node_modules/startbootstrap-sb-admin/js/sb-admin-datatables.min.js',
    'node_modules/startbootstrap-sb-admin/js/sb-admin-charts.min.js',
], 'public/assets/js/admin-sb.js');


