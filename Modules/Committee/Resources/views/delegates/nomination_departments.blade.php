@if(auth()->user()->hasPermissionWithAccess('addDelegatesToCommittee','DelegateController','Users')
&& auth()->user()->hasPermissionWithAccess('getNominationDepartmentsWithRef','CommitteeController','Committee'))
    @if ($committee->getNominationDepartmentsWithRef()!==null)

        <table class="table table-striped table-responsive-md">
            <thead>
            <label class="underLine">{{ __('committee::committees.nomination_departments') }}

            </label>
            @if(auth()->user()->hasPermissionWithAccess('create','DelegateController','Users'))

                <a  class="btn btn-sm btn-info" style="float: left;margin-left: 10%;background-color: rgb(5, 125, 84);" data-toggle="modal"
                   data-target="#addDelegateModal">
                    {{ __('committee::committees.nomination_add_delegte') }}
                </a>
            @endif
            <tr>
                <th style="width: 8%" scope="col"></th>
                <th scope="col">{{ __('committee::committees.nomination_deparment_name') }}</th>
                <th scope="col">{{ __('committee::committees.nomination_criteria') }}</th>
                <th scope="col">{{ __('committee::committees.nomination_has_nomination') }}</th>
                <th scope="col">{{ __('committee::committees.nomination_options') }}</th>

            </tr>
            </thead>
            <tbody id="nominationTable">

            @foreach($committee->getNominationDepartmentsWithRef() as $department)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        {{ $department->referenceDepartment==null?  $department->name: $department->name." / ". $department->referenceDepartment->name}}
                    </td>
                    <td>
                        {{ ($department->pivot->nomination_criteria==null)?'لا يوجد': $department->pivot->nomination_criteria }}
                    </td>
                    <td id="{{$department->id}}">
                        {{ $department->pivot->has_nominations==1?__('committee::committees.nomination_done'):__('committee::committees.nomination_not_done') }}
                    </td>
                    <td>
                        @if(auth()->user()->hasPermissionWithAccess('addDelegatesToCommittee','DelegateController','Users'))
                            <button data-toggle="modal" value="{{$department->id}}"
                                    class="btn btn-primary nominateBtn">{{__('committee::committees.nominate')}}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @include('users::delegates.index',compact('committee'))
    @include('users::delegates.create',compact('committee'))
@endif





