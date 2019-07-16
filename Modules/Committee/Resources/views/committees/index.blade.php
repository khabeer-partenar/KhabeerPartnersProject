@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.manage') }}</span>
            </div>

            @if(auth()->user()->hasPermissionWithAccess('create'))
                <div class="actions">
                    <a href="{{ route('committees.create') }}" class="btn btn-primary">{{ __('committee::committees.action_add') }}</a>
                </div>
            @endif

        </div>

        <div class="portlet-body">

            {{-- DataTable --}}
            <table id="table-ajax" class="table" data-url="{{ route('committees.index', [
                'name' => Request::input('name'),
                'main_department_id' => Request::input('main_department_id'),
                'parent_department_id' => Request::input('parent_department_id')
                ])
             }}"
                   data-fields='[
                    {{--{"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},--}}
                    {{--{"data": "department_info","name":"actions","title":"{{ __('messages.department_info') }}","searchable":"false", "orderable":"false"},--}}
                    {{--{"data": "contact_options","name":"actions","title":"{{ __('messages.contact_options') }}","searchable":"false", "orderable":"false"},--}}
                    {{--{"data": "action","name":"actions","searchable":"false", "orderable":"false"}--}}
                ]'
            >
            </table>
        </div>

    </div>
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
