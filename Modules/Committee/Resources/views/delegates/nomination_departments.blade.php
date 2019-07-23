{{-- Nomination Departments --}}


<table class="table table-striped table-responsive-md">
    <thead>
    <label class="underLine">{{ __('committee::committees.nomination_departments') }}

    </label>
    <a style="color:blue; float: left;margin-left: 10%;" >{{ __('committee::committees.nomination_add_delegte') }}</a>
    <tr>
        <th style="width: 16.666%" scope="col"></th>
        <th scope="col">{{ __('committee::committees.nomination_deparment_name') }}</th>
        <th scope="col">{{ __('committee::committees.nomination_criteria') }}</th>
        <th scope="col">{{ __('committee::committees.nomination_has_nomination') }}</th>
        <th scope="col">{{ __('committee::committees.nomination_options') }}</th>

    </tr>
    </thead>
    <tbody>
    @foreach($committee->nominationDepartments as $department)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                {{ $department->name }}
            </td>
            <td>
                {{ $department->pivot->nomination_criteria }}
            </td>
            <td>
                {{ $department->pivot->has_nominations?__('committee::committees.nomination_done'):__('committee::committees.nomination_not_done') }}
            </td>
            <td>
                <button data-toggle="modal" data-target="#nominationsListModal" class="btn btn-primary">{{__('committee::committees.nominate')}}</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('users::delegates.index')




