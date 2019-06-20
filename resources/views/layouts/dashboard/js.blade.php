{{--Common Scripts--}}
{{ Html::script(mix('assets/js/jquery.js')) }}
{{ Html::script(mix('assets/js/select2.full.js'))}}
{{ Html::script(mix('assets/js/components-select2.js'))}}

{{ Html::script(mix('assets/js/app.js')) }}

<!-- BEGIN CORE PLUGINS -->
{{ Html::script(mix('assets/js/core.js')) }}
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('scripts')

{{ Html::script(mix('assets/js/table-datatables-editable.min.js'))}}
{{ Html::script(mix('assets/js/additional-methods.js'))}}
{{ Html::script(mix('assets/js/jquery-bootstrap-wizard.js'))}}

{{ Html::script(mix('assets/js/jquery.validate_ar.js'))}}

{{ Html::script(mix('assets/js/bootstrap-select.min.js'))}}
{{ Html::script(mix('assets/js/jquery.multi-select.js'))}}

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
{{ Html::script(mix('assets/js/app-metronic.js'))}}
{{ Html::script(mix('assets/js/datatables.all.min.js'))}}
{{ Html::script(mix('assets/js/datatables.bootstrap.js'))}}
{{ Html::script(mix('assets/js/components-datatable_ar.js'))}}
{{ Html::script(mix('assets/js/components-multi-select.min.js'))}}
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('scripts_2')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
{{ Html::script(mix('assets/js/layout.js')) }}
{{ Html::script(mix('assets/js/laravel-forms.js')) }}
{{ Html::script(mix('assets/js/custom.js')) }}
{{ Html::script(mix('assets/js/multi-input.js')) }}

<!-- END THEME LAYOUT SCRIPTS -->

{{ Html::script(mix('assets/js/menu-toggler-sidebar.js')) }}


{{ Html::script(mix('assets/js/functions.js')) }}