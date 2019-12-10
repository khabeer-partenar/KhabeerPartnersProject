@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-edit"></i>
                        <span class="caption-subject sbold">{{ __('users::employees.assignCommittees.editAdvisorsTitle') }}: {{ $employee->name }}</span>
                    </div>
                </div>
            
                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        <a href="{{ route('employees.assign_committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::model($employee, ['route' => ['employees.assign_committees.update', $employee], 'method' => 'PUT']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('advisors_ids') ? ' has-error' : '' }}">
                                {!! Form::select('advisors_ids[]', $advisorsEmployees, null, ['id' => 'advisors_ids', 'multiple' => 'multiple']) !!}
                                                    
                                @if ($errors->has('advisors_ids'))
                                    <span class="help-block" ><strong>{{ $errors->first('advisors_ids') }}</strong></span>
                                @endif
                            </div>
                        </div>
                            
                    </div>

                </div>

                <div class="form-actions  item-fl item-mt10">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection


@section('scripts_2')

    <script>
    $(document).ready(function() {

        $("#advisors_ids").val({{$advisorsIDs}});

        $('#advisors_ids').multiSelect({
            selectableHeader: "<div class='multiselect_title'>{{ __('users::employees.assignCommittees.advisorsSelectedTitle') }}</div>",
            selectionHeader: "<div class='multiselect_title'>{{ __('users::employees.assignCommittees.advisorsUnSelectedTitle') }}</div>",
        });

    });
    </script>
@endsection