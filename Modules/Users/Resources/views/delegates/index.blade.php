{{--@extends('layouts.dashboard.index')--}}

<!-- Modal -->
<div id="nominationsListModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-notify modal-info" role="document" style="width: auto; margin: 10%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('users::delegates.nominate_title') }}</strong>

                </p>
                <div class="clearfix"></div>

            </div>
            {{ Form::open(['route' => 'delegates.add_delegate', 'method' => 'POST', 'id' => 'delegate-form']) }}

            <div class="modal-body">
                <table id="table-ajax" class="table" data-url="{{ route('delegates.index')}}"
                       data-fields='[
                    {"data": "department_info","name":"actions","title":"{{ __('users::delegates.department_name') }}","searchable":"false", "orderable":"false"},
                    {"data": "name","name":"actions","title":"{{ __('users::delegates.delegate_name') }}","searchable":"false", "orderable":"false"},
                    {"data": "job_title","name":"actions","title":"{{ __('users::delegates.job_title') }}","searchable":"false", "orderable":"false"},
                    {"data": "national_id","name":"actions","title":"{{ __('users::delegates.national_id') }}","searchable":"false", "orderable":"false"},
                    {"data": "phone_number","name":"actions","title":"{{ __('users::delegates.phone_number') }}","searchable":"false", "orderable":"false"},
                    {"data": "email","name":"actions","title":"{{ __('users::delegates.email') }}","searchable":"false", "orderable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}]'
                >
                </table>
            </div>
            <div class="modal-footer">
                {{ Form::button(__('users::delegates.action_add'), ['type' => 'submit', 'class' => 'btn blue']) }}

                <button style="float: right" type="button" class="btn btn-primary">{{__('users::delegates.close_window')}}</button>

            </div>

            {{ Form::close() }}
        </div>

    </div>
</div>


