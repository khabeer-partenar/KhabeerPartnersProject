<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{ Html::style(mix('assets/css/fonts.css')) }}
{{ Html::style(mix('assets/css/main.css')) }}
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('styles')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL STYLES -->
{{ Html::style(mix('assets/css/global.css')) }}
<!-- END THEME GLOBAL STYLES -->

<!-- BEGIN THEME LAYOUT STYLES -->
{{ Html::style(mix('assets/css/layout.css')) }}
<!-- END THEME LAYOUT STYLES -->

{{ Html::style('https://fonts.googleapis.com/css?family=Cairo:400,600,700,900&amp;subset=arabic') }}

<link href="/assets/img/favicon.ico" rel="shortcut icon">

{{ Html::style(mix('assets/css/dashboard_layout.css')) }}
