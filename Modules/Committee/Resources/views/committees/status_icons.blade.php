@if ($committee)
    <div class="row"  style="display: flex;text-align: center;margin: auto">
        @if ($committee->created_at->format('Y-m-d') == Carbon\Carbon::today()->format('Y-m-d'))
            <i title="{{__('committee::committees.icon_new_title')}}" class="fa fa-lg fa-file"
               style="color:green;margin-left: 3px;"></i>
        @endif
        @if ($committee->urgent_committee == true)
            <i title="{{__('committee::committees.icon_urgent_title')}}" class="fa fa-lg fa-exclamation-triangle"
               style="color:red;margin-left: 3px;"></i>
        @endif
        @if ($committee->treatment_importance_id == \Modules\Committee\Entities\TreatmentImportance::SECRET
            || $committee->treatment_importance_id == \Modules\Committee\Entities\TreatmentImportance::VERY_SECRET)
            <i title="{{__('committee::committees.icon_importance_title')}}" class="fa fa-lg fa-lock"
               style="color:darkorange;margin-left: 3px;"></i>
        @endif
        @if ($committee->view)
            <i title="{{__('committee::committees.icon_read_title')}}" class="fa fa-lg fa-envelope-open-o"
               style="margin-left: 3px;"></i>
        @else
                <i title="{{__('committee::committees.icon_un_read_title')}}" class="fa fa-lg fa-envelope-o"
                   style="margin-left: 3px;"></i>
        @endif
            @if (auth()->user()->user_type == 'user' && $committee->approved)
                <i title="{{__('committee::committees.icon_approved_title')}}" class="fa fa-lg fa-check"
                   style="color:green"></i>
            @endif
    </div>
@endif

