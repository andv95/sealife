const mix = require('laravel-mix');

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

// SITE CSS
mix.combine([
    'public/site_assets/lib/bootstrap/css/bootstrap.min.css',
    'public/site_assets/lib/flatpickr/flatpicker.min.css',
    'public/site_assets/lib/fontawesome/css/all.css',
    'public/site_assets/lib/OwlCarousel/dist/assets/owl.carousel.min.css',
    'public/site_assets/lib/OwlCarousel/dist/assets/owl.theme.default.min.css',
    'public/site_assets/lib/slick/slick/slick.css',
    'public/site_assets/lib/slick/slick/slick-theme.css',
    'public/site_assets/lib/Magnific-Popup/dist/magnific-popup.css',
    'public/site_assets/lib/select2/select2.min.css',
    'public/site_assets/css/site_style.css',
    'public/site_assets/css/loading-style.css',
    'public/site_assets/css/site_responsive.css',

], 'public/app/css/site.css').sourceMaps().version();

// SITE JS
mix.combine([
    'public/site_assets/lib/jquery-3-4-1.min.js',
    'public/site_assets/lib/flatpickr/flatpicker.min.js',
    'public/site_assets/lib/flatpickr/vn.js',
    'public/site_assets/lib/bootstrap/js/bootstrap.min.js',
    'public/site_assets/lib/OwlCarousel/dist/owl.carousel.min.js',
    'public/site_assets/lib/slick/slick/slick.min.js',
    'public/site_assets/lib/Magnific-Popup/dist/jquery.magnific-popup.min.js',
    'public/site_assets/lib/select2/select2.min.js',
    'public/site_assets/js/system.js',
    'public/site_assets/js/script.js',
    'public/site_assets/js/script_2.js',

], 'public/app/js/site.js').sourceMaps().version();


// HOME CSS
mix.combine([
    'public/site_assets/lib/bootstrap/css/bootstrap.min.css',
    'public/site_assets/lib/flatpickr/flatpicker.min.css',
    'public/site_assets/lib/OwlCarousel/dist/assets/owl.carousel.min.css',
    'public/site_assets/lib/OwlCarousel/dist/assets/owl.theme.default.min.css',
    'public/site_assets/lib/Magnific-Popup/dist/magnific-popup.css',
    'public/site_assets/css/fas.css',
    'public/site_assets/css/site_style.css',
    'public/site_assets/css/loading-style.css',
    'public/site_assets/css/site_responsive.css',

], 'public/app/css/home.css').sourceMaps().version();

// HOME JS
mix.combine([
    'public/site_assets/lib/jquery-3-4-1.min.js',
    'public/site_assets/lib/flatpickr/flatpicker.min.js',
    'public/site_assets/lib/flatpickr/vn.js',
    //'public/site_assets/lib/bootstrap/js/bootstrap.min.js',
    'public/site_assets/lib/OwlCarousel/dist/owl.carousel.min.js',
    'public/site_assets/lib/Magnific-Popup/dist/jquery.magnific-popup.min.js',
    'public/site_assets/js/system.js',
    'public/site_assets/js/script.js',
    'public/site_assets/js/script_2.js',

], 'public/app/js/home.js').sourceMaps().version();

mix.disableNotifications();
