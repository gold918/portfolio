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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    "resources/assets/vendor/bootstrap/css/bootstrap.min.css",
    "resources/assets/vendor/icofont/icofont.min.css",
    "resources/assets/vendor/boxicons/css/boxicons.min.css",
    "resources/assets/vendor/owl.carousel/assets/owl.carousel.min.css",
    "resources/assets/vendor/venobox/venobox.css",
    "resources/assets/vendor/remixicon/remixicon.css",
    "resources/assets/vendor/aos/aos.css",

    "resources/assets/css/style.css",
], 'public/css/index.css');

mix.styles([
    "resources/admin/assets/bootstrap/css/bootstrap.min.css",
    "resources/admin/assets/font-awesome/4.5.0/css/font-awesome.min.css",
    "resources/admin/assets/ionicons/2.0.1/css/ionicons.min.css",
    "resources/admin/assets/plugins/datepicker/datepicker3.css",
    "resources/admin/assets/plugins/select2/select2.min.css",
    "resources/admin/assets/plugins/datatables/dataTables.bootstrap.css",
    "resources/admin/assets/plugins/iCheck/minimal/_all.css",
    "resources/admin/assets/dist/css/AdminLTE.min.css",
    "resources/admin/assets/dist/css/skins/_all-skins.min.css",
    "resources/assets/vendor/remixicon/remixicon.css",
    "resources/assets/vendor/boxicons/css/boxicons.min.css",
    "resources/assets/vendor/icofont/icofont.min.css",
    "resources/admin/assets/css/style.css",
], 'public/css/admin.css');

mix.scripts([
    "resources/assets/vendor/jquery/jquery.min.js",
    "resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js",
    "resources/assets/vendor/jquery.easing/jquery.easing.min.js",
    "resources/assets/vendor/php-email-form/validate.js",
    "resources/assets/vendor/owl.carousel/owl.carousel.min.js",
    "resources/assets/vendor/isotope-layout/isotope.pkgd.min.js",
    "resources/assets/vendor/venobox/venobox.min.js",
    "resources/assets/vendor/waypoints/jquery.waypoints.min.js",
    "resources/assets/vendor/counterup/counterup.min.js",
    "resources/assets/vendor/aos/aos.js",

    // Template Main JS File
    "resources/assets/js/main.js",
], 'public/js/index.js');

mix.scripts([
    "resources/admin/assets/plugins/jQuery/jquery-2.2.3.min.js",
    "resources/admin/assets/bootstrap/js/bootstrap.min.js",
    "resources/admin/assets/plugins/select2/select2.full.min.js",
    "resources/admin/assets/plugins/datepicker/bootstrap-datepicker.js",
    "resources/admin/assets/plugins/datatables/jquery.dataTables.min.js",
    "resources/admin/assets/plugins/datatables/dataTables.bootstrap.min.js",
    "resources/admin/assets/plugins/slimScroll/jquery.slimscroll.min.js",
    "resources/admin/assets/plugins/fastclick/fastclick.js",
    "resources/admin/assets/plugins/iCheck/icheck.min.js",
    "resources/admin/assets/dist/js/app.min.js",
    "resources/admin/assets/dist/js/demo.js",
    "resources/admin/assets/script/script.js",
], 'public/js/admin.js');


