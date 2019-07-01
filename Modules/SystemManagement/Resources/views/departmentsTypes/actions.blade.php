@if($departmentsData)

    <a href="#" class="btn btn-sm btn-primary">
        <i class="fa fa-eye"></i> {{ __('users::employees.information_btn') }}
    </a>
    
    <a data-href="#" class="btn btn-sm btn-danger delete-row">
        <i class="fa fa-trash"></i> {{ __('users::employees.delete_btn') }}
    </a>

@endif