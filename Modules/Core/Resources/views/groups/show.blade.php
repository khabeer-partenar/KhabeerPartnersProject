@extends('layouts.dashboard.index')

@section('page')

    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <i class="fa fa-users"></i>
                    {{ $group->name }}
                </div>
                
                <div class="panel-body">

                    <div class="row">
                        
                        <div class="col-md-12">

                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <i class="fa fa-user"></i> المجموعات التابعة
                                </div>
                            
                                <div class="panel-body">
                                    <table id="table-ajax" class="table panel-body delete-object-modal-table"
                                        data-form="deleteForm"
                                        data-url="/core/groups/id-{{ $group->id }}"
                                        data-fields='[
                                            {"data": "name","title":"{{ __('core::groups.title') }}","searchable":"true"},
                                            {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                                        ]'>
                                    </table>
                                </div>
                        
                            </div>
                    
                        </div>
                    
                    </div>

                    <div class="row">
                        <attach-user-to-group
                            group-id="{{ $group->id }}"
                            attach-url="{{ route('attach_user_to_group', $group->id) }}"
                            detach-url="{{ route('detach_user_to_group', ['id' => $group->id, 'userId' => ""]) }}"
                            users-url="{{ route('group_users', $group->id)  }}">
                        </attach-user-to-group>
                    </div>
                
                </div>
            
                <div class="panel-footer"></div>
        
            </div>
    
        </div>
    </div>

@endsection
