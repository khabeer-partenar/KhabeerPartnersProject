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

mix

    /*
    |--------------------------------------------------------------------------
    | Main css
    |--------------------------------------------------------------------------
    |
    */
    .combine([
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/simple-line-icons.min.css',
        'resources/assets/css/bootstrap-rtl.min.css',
        'resources/assets/css/bootstrap-switch-rtl.min.css',
        'resources/assets/css/select2_ar.min.css',
        'resources/assets/css/select2-bootstrap_ar.min.css',
        'resources/assets/css/datatables.min.css',
        'resources/assets/css/bootstrap-datepicker.css',
        'resources/assets/css/datatables.bootstrap.css',
        'resources/assets/css/datatables.bootstrap-rtl.css',
        'resources/assets/css/jquery.calendars.picker.css',
        'resources/assets/css/multi-select-rtl.css',
        'resources/assets/css/custom.css'
    ], 'public/assets/css/main.css')


    /*
    |--------------------------------------------------------------------------
    | Global css
    |--------------------------------------------------------------------------
    |
    */
    .combine([
        'resources/assets/css/components-rtl.min.css',
        'resources/assets/css/plugins-rtl.min.css'
    ], 'public/assets/css/global.css')


    /*
    |--------------------------------------------------------------------------
    | Layout css
    |--------------------------------------------------------------------------
    |
    */
    .combine([
       'resources/assets/css/layout-rtl.min.css',
       'resources/assets/css/darkblue-rtl.min.css'
    ], 'public/assets/css/layout.css')

    .copy('resources/assets/css/dashboard_layout.css', 'public/assets/css/dashboard_layout.css')

    /*
    |--------------------------------------------------------------------------
    | Login css
    |--------------------------------------------------------------------------
    |
    */
    .copy('resources/assets/css/login-rtl.min.css', 'public/assets/css/login.css')
    .copy('resources/assets/css/statement-print.css', 'public/assets/css/statement-print.css')

    /*
    |--------------------------------------------------------------------------
    | Fonts css
    |--------------------------------------------------------------------------
    |
    */
    .copy('resources/assets/css/fonts.css', 'public/assets/css/fonts.css')
    



    /*
    |--------------------------------------------------------------------------
    | Core Js
    |--------------------------------------------------------------------------
    |
    */
    .copy('resources/assets/js/vendor/jquery.min.js', 'public/assets/js/jquery.js')
    .js('resources/assets/js/app.js', 'public/assets/js/app.js').version()
    
    .combine([
        'resources/assets/js/vendor/bootstrap.min.js',
        'resources/assets/js/vendor/js.cookie.min.js',
        'resources/assets/js/vendor/jquery.slimscroll.min.js',
        'resources/assets/js/vendor/jquery.blockui.min.js',
        'resources/assets/js/vendor/bootstrap-switch.min.js',
        'resources/assets/js/vendor/jquery.plugin.js',
        'resources/assets/js/vendor/jquery.calendars.js',
        'resources/assets/js/vendor/jquery.calendars.plus.js',
        'resources/assets/js/vendor/jquery.calendars.picker.js',
        'resources/assets/js/vendor/jquery.calendars.picker-ar.js',
        'resources/assets/js/vendor/jquery.calendars.ummalqura.min.js',
        'resources/assets/js/vendor/jquery.calendars.ummalqura-ar.js',
    ], 'public/assets/js/core.js')
    
    .copy('resources/assets/js/vendor/app-metronic.min.js', 'public/assets/js/app-metronic.js')
    
    /*
    |--------------------------------------------------------------------------
    | Global scripts
    |--------------------------------------------------------------------------
    |
    */
    .combine([
        'resources/assets/js/vendor/layout.min.js',
        'resources/assets/js/vendor/demo.min.js',
        'resources/assets/js/vendor/quick-sidebar.min.js',
        'resources/assets/js/vendor/quick-nav.min.js',
    ], 'public/assets/js/layout.js')
    
    /*
    |--------------------------------------------------------------------------
    | Plugins scripts
    |--------------------------------------------------------------------------
    |
    */
    .copy('resources/assets/js/vendor/jquery.validate.min.js', 'public/assets/js/jquery.validate.js')
    .copy('resources/assets/js/vendor/jquery.validate_ar.min.js', 'public/assets/js/jquery.validate_ar.js')
    .copy('resources/assets/js/vendor/additional-methods.min.js', 'public/assets/js/additional-methods.js')
    .copy('resources/assets/js/vendor/jquery.backstretch.min.js', 'public/assets/js/jquery.backstretch.js')
    .copy('resources/assets/js/vendor/select2.full.min.js', 'public/assets/js/select2.full.js')
    .copy('resources/assets/js/vendor/components-select2.js', 'public/assets/js/components-select2.js')
    .copy('resources/assets/js/vendor/datatables.all.min.js', 'public/assets/js/datatables.all.min.js')
    .copy('resources/assets/js/vendor/datatables.bootstrap.js', 'public/assets/js/datatables.bootstrap.js')
    .copy('resources/assets/js/vendor/components-datatable_en.js', 'public/assets/js/components-datatable_en.js')
    .copy('resources/assets/js/vendor/components-datatable_ar.js', 'public/assets/js/components-datatable_ar.js')
    .copy('resources/assets/js/vendor/login.min.js', 'public/assets/js/login.js')
    .js('resources/assets/js/vendor/laravel-forms.js', 'public/assets/js/laravel-forms.js')
    .copy('resources/assets/js/vendor/form-wizard.min.js', 'public/assets/js/form-wizard.js')
    .copy('resources/assets/js/vendor/jquery-bootstrap-wizard.min.js', 'public/assets/js/jquery-bootstrap-wizard.js')
    .copy('resources/assets/js/vendor/additional-methods.js', 'public/assets/js/additional-methods.js')
    .js('resources/assets/js/custom.js', 'public/assets/js/custom.js')
    .js('resources/assets/js/vendor/multi-input.js', 'public/assets/js/multi-input.js')
    .copy('resources/assets/js/vendor/jquery.form.min.js', 'public/assets/js/jquery.form.min.js')
    .copy('resources/assets/js/vendor/sweetalert.min.js', 'public/assets/js/sweetalert.min.js')
    .copy('resources/assets/js/vendor/jquery.multi-select.js', 'public/assets/js/jquery.multi-select.js')
    .copy('resources/assets/js/vendor/bootstrap-select.min.js', 'public/assets/js/bootstrap-select.min.js')
    .copy('resources/assets/js/vendor/bootstrap-datepicker.min.js', 'public/assets/js/bootstrap-datepicker.min.js')
    .copy('resources/assets/js/vendor/locals/bootstrap-datepicker-ar.js', 'public/assets/js/bootstrap-datepicker-ar.min.js')
    .copy('resources/assets/js/vendor/components-multi-select.min.js', 'public/assets/js/components-multi-select.min.js')
    .copy('resources/assets/js/vendor/table-datatables-editable.min.js', 'public/assets/js/table-datatables-editable.min.js')
      
    .copy('resources/assets/js/vendor/menu-toggler-sidebar.js', 'public/assets/js/menu-toggler-sidebar.js')
    .copy('resources/assets/js/khabeer.js', 'public/assets/js/khabeer.js');
