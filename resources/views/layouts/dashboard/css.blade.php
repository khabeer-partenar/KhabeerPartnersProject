<!-- BEGIN GLOBAL MANDATORY STYLES -->

{{ Html::style(mix('assets/css/bootstrap-rtl.min.css')) }}
{{ Html::style('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
{{ Html::style(mix('assets/css/fonts.css')) }}
{{ Html::style(mix('assets/css/colorbox.css')) }}
{{ Html::style(mix('assets/css/styles_ar.css')) }}
{{ Html::style(mix('assets/css/main.css')) }}
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('styles')
<!-- END PAGE LEVEL PLUGINS -->
