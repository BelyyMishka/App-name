const mix = require('laravel-mix');

mix.styles([
    'resources/assets/admin/css/all.css',
    'resources/assets/admin/css/adminlte.css',
], 'public/assets/admin/css/all.css');

mix.scripts([
    'resources/assets/admin/js/jquery.js',
    'resources/assets/admin/js/bootstrap.bundle.js',
    'resources/assets/admin/js/adminlte.js',
    'resources/assets/admin/js/demo.js',
], 'public/assets/admin/js/all.js');

mix.copy('resources/assets/admin/js/adminlte.js.map', 'public/assets/admin/js/adminlte.js.map');
mix.copy('resources/assets/admin/css/adminlte.css.map', 'public/assets/admin/css/adminlte.css.map');
mix.copyDirectory('resources/assets/admin/fonts/webfonts', 'public/assets/admin/webfonts');
mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');
