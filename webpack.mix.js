const { mix } = require('laravel-mix');

mix.setPublicPath('public/');
mix.js('src/app.js', 'public/js')
    .sass('src/sass/app.scss', 'public/css');

//.sass('resources/assets/sass/oldbrowsers.scss', 'public/css');
