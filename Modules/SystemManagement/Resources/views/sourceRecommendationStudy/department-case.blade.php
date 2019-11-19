@if($departmentData)
    
    @if($departmentData->shown_in_committee_recommended)
        <span class="badge badge-info badge-roundless">الجهة الموصية بالدراسة</span>
    @endif

    @if($departmentData->shown_in_committee_recommended && $departmentData->shown_in_committee_source_of_study)
        <br>
    @endif
    
    @if($departmentData->shown_in_committee_source_of_study)
        <span class="badge badge-info badge-roundless">الجهة مصدر الدراسة</span>
    @endif

@endif