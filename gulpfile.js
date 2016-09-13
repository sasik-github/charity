var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix
        .sass('app.scss')
        .styles([
            '../../../public/css/app.css',
            'vendor/bootstrap-datetimepicker.min.css',
            'vendor/dropzone.css',
            '../../../node_modules/cropperjs/dist/cropper.min.css',
        ]);

    mix.scripts(
        [
            '../../../node_modules/moment/min/moment-with-locales.min.js',
            'vendor/bootstrap-datetimepicker.min.js',
            'vendor/dropzone.js',
            '../../../node_modules/cropperjs/dist/cropper.min.js',
            'fileuploader.js',
        ]
    );

    mix.version([
        'css/all.css',
        'js/all.js'
    ]);

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/build/fonts/bootstrap/');
});
