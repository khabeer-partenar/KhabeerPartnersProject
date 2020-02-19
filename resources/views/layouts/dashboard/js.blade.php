{{--Common Scripts--}}
{{ Html::script(mix('assets/js/jquery.js')) }}

<script src="{{ url(mix('assets/js/jquery.hoverIntent.minified.js')) }}" defer></script>
<script src="{{ url(mix('assets/js/jquery.slicknav.js')) }}" defer></script>
<script src="{{ url(mix('assets/js/slick.js')) }}" defer></script>
<script src="{{ url(mix('assets/js/tabs.js')) }}" defer></script>
<script src="{{ url(mix('assets/js/jquery.colorbox-min.js')) }}" defer></script>

{{ Html::script(mix('assets/js/jquery.colorbox-min.js')) }}

{{ Html::script(mix('assets/js/select2.full.js'))}}
{{ Html::script(mix('assets/js/components-select2.js'))}}


<!-- BEGIN CORE PLUGINS -->
{{ Html::script(mix('assets/js/core.js')) }}
{{ Html::script(mix('assets/js/app.js')) }}

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('scripts')

{{ Html::script(mix('assets/js/table-datatables-editable.min.js'))}}
{{ Html::script(mix('assets/js/jquery-bootstrap-wizard.js'))}}

{{ Html::script(mix('assets/js/jquery.validate_ar.js'))}}

{{ Html::script(mix('assets/js/bootstrap-select.min.js'))}}
{{ Html::script(mix('assets/js/jquery.multi-select.js'))}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
{{ Html::script(mix('assets/js/app-metronic.js'))}}
{{ Html::script(mix('assets/js/datatables.all.min.js'))}}
{{ Html::script(mix('assets/js/datatables.bootstrap.js'))}}
{{ Html::script(mix('assets/js/components-datatable_ar.js'))}}
{{ Html::script(mix('assets/js/components-multi-select.min.js'))}}

<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN CALENDAR SCRIPTS PLUGIN -->

{{ Html::script(mix('assets/js/calendar/core/main.js'))}}
{{ Html::script(mix('assets/js/calendar/core/locales-all.js'))}}
{{ Html::script(mix('assets/js/calendar/interaction/main.js'))}}
{{ Html::script(mix('assets/js/calendar/daygrid/main.js'))}}
{{ Html::script(mix('assets/js/calendar/timegrid/main.js'))}}
{{ Html::script(mix('assets/js/calendar/list/main.js'))}}

<!-- END CALENDAR SCRIPTS PLUGIN -->

<!-- BEGIN MOMENTS SCRIPTS PLUGIN -->
{{ Html::script(mix('assets/js/moment.js'))}}
<!-- END MOMENTS SCRIPTS PLUGIN -->

<!-- BEGIN Persian SCRIPTS PLUGIN -->
{{ Html::script(mix('assets/js/persian.js'))}}
<!-- END Persian SCRIPTS PLUGIN -->


{{ Html::script(mix('assets/js/custom.js')) }}
{{ Html::script(mix('assets/js/khabeer.js')) }}
{{ Html::script(mix('assets/js/khabeer-validations.js')) }}

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
{{ Html::script(mix('assets/js/bootstrap-datepicker.min.js')) }}
{{ Html::script(mix('assets/js/bootstrap-datetimepicker.min.js')) }}
{{ Html::script(mix('assets/js/bootstrap-timepicker.min.js')) }}
{{ Html::script(mix('assets/js/bootstrap-datepicker-ar.min.js')) }}


