<div class="portlet light bordered">

    <div class="portlet-title">

        <div class="caption">
            <i class="fa fa-users"></i>
            <span class="caption-subject sbold">{{ __('users::employees.secretaries') }}</span>
        </div>
            
        <div class="actions">
            <a href="{{ route('employees.edit_secretaries', $employee) }}" class="btn blue"><i class="fa fa-edit"></i> {{ __('users::employees.edit_secretaries_btn') }}</a>
        </div>
        
    </div>

    <div class="portlet-body form">
            
        <div class="form-body">
            
            <table id="table-ajax" class="table" data-url="{{ route('employees.secretaries', $employee) }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('messages.deptname') }}","searchable":"false"},
                    {"data": "email","title":"{{ __('messages.email') }}","searchable":"false"},
                    {"data": "phone_number","title":"{{ __('messages.phone_number') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::employees.job_role_id') }}","searchable":"false"}
                ]'
            >
            </table>

        </div>

    </div>

</div>