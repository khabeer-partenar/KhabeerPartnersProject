{{--@extends('layouts.dashboard.index')--}}

<!-- Modal -->
<div id="nominationsListModal" class="modal fade" role="dialog">
    <div class="modal-lg modal-notify modal-info" role="document" style="width: auto; margin: 10%;">

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

            <div class="modal-body">

                <table class="table table-striped table-responsive-md">
                    <thead>

                    <tr>
                        <th style="width: 16.666%" scope="col"></th>
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
                   {{-- @foreach($delegatesQuery as $delegate)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{ $delegate->department->name,
                                $delegate->referenceDepartment ? '/' . $delegate->referenceDepartment->name:null}}
                            </td>
                            <td>
                                {{ $delegate->name }}
                            </td>
                            <td>
                                {{ $delegate->job_title }}
                            </td>
                            <td>
                                {{$delegate->national_id}}

                            </td>
                            <td>
                               {{ $delegate->phone_number}}
                            </td>
                            <td>
                                {{$delegate->email}}
                            </td>
                            <td>
                                {{$delegate->specialty}}
                            </td>
                            <td>
                                {{ Form::checkbox('delegates_ids[]',$delegate->id,null, array('id'=>'delegates_ids')) }}

                            </td>
                        </tr>
                    @endforeach--}}
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                {{ Form::button(__('users::delegates.action_add'), ['type' => 'submit', 'class' => 'btn blue']) }}

                <button style="float: right" type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>
            {{ Form::hidden('committee_id', $committee->id) }}


            {{ Form::close() }}
        </div>

    </div>
</div>



