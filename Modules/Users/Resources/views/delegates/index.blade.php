{{--@extends('layouts.dashboard.index')--}}

<!-- Modal -->
<div id="nominationsListModal" class="modal fade" role="dialog">
    <div class="modal-lg modal-notify modal-info" role="document" style="overflow-y: initial !important;width: auto; margin: 5%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('users::delegates.nominate_title') }}</strong>

                </p>
                <div class="clearfix"></div>

            </div>
            {{ Form::open(['route' => 'delegates.add_delegates', 'method' => 'POST', 'id' => 'delegate-form']) }}

            <div class="modal-body" style="height: 400px;overflow-y: auto;">

                <table class="table table-striped table-responsive-md">
                    <thead>

                    <tr style="font-weight:bold">
                        <th style="width:7%" scope="col"></th>
                        <th scope="col">{{ __('users::delegates.department_name') }}</th>
                        <th scope="col">{{ __('users::delegates.delegate_name') }}</th>
                        <th scope="col">{{ __('users::delegates.job_title') }}</th>
                        <th scope="col">{{ __('users::delegates.national_id') }}</th>
                        <th scope="col">{{ __('users::delegates.phone_number') }}</th>
                        <th scope="col">{{ __('users::delegates.email') }}</th>
                        <th scope="col">{{ __('users::delegates.specialty') }}</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody id="table_delegates">

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                {{ Form::button(__('users::delegates.action_add'), ['type' => 'submit', 'class' => 'btn blue']) }}

                <button  type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>
            {{ Form::hidden('committee_id', $committee->id) }}
            {{ Form::hidden('department_id', '',array('id' => 'department_id')) }}


            {{ Form::close() }}
        </div>

    </div>
</div>



