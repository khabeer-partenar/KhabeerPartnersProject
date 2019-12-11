@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">
    
        <div class="portlet-title">
            
            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold uppercase">{{ __('core::groups.title') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess(false, false, 'create'))
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <a href="{{ route('core.groups.create') }}" class="btn btn-primary">{{ __('core::groups.action_add')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
      
        </div>
        
        <table id="table-ajax" class="table panel-body delete-object-modal-table"
            data-form="deleteForm"
            data-url="/core/groups"
            data-fields='[
                {"data": "name","title":"{{ __('core::groups.name') }}","searchable":"true"},
                {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
            ]'>
        </table>
    
    </div>

@endsection
