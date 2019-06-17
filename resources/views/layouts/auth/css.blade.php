{{ Html::style(mix('assets/css/main.css')) }}

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('styles')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL STYLES -->
{{ Html::style(mix('assets/css/global.css')) }}
<!-- END THEME GLOBAL STYLES -->

{{ Html::style(mix('assets/css/login.css')) }}