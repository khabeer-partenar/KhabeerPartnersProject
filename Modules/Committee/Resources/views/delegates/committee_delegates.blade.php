@if(auth()->user()->hasPermissionWithAccess('addDelegatesToCommittee'))
    <p class="underLine">{{ __('committee::committees.delegates_title') }}</p>

    <table id="delegatestable2" class="table table-striped table-responsive-md">
        <thead>
        <tr>
            <th style="width: 8%" scope="col"></th>
            <th scope="col">{{ __('committee::committees.delegates_department') }}</th>
            <th scope="col">{{ __('committee::committees.delegate_name') }}</th>
            <th scope="col">{{ __('committee::committees.delegate_national_id') }}</th>
            <th scope="col">{{ __('committee::committees.delegate_phone') }}</th>
            <th scope="col">{{ __('committee::committees.delegate_email') }}</th>
            <th scope="col">{{ __('committee::committees.delegate_options') }}</th>

        </tr>
        </thead>
        <tbody id="delegatesTable">
        @foreach($delegates as $delegate)
            <tr>
                <td>{{ $loop->index + 1 }}
                    <input id="committee_id" type="hidden" value="{{$committee->id}}">
                </td>
                <td>
                    {{ $delegate->department->name }} {{ $delegate->department->referenceDepartment ? ' - ' . $delegate->department->referenceDepartment->name:'' }}
                </td>
                <td>
                    {{ $delegate->name }}
                </td>
                <td>
                    {{ $delegate->national_id}}
                </td>
                <td>
                    {{ $delegate->phone_number}}
                </td>
                <td>
                    {{ $delegate->email}}
                </td>
                <td>
                    <a data-href="{{ route('delegate.remove.from.committee',['delegate_id'=>$delegate->id,'committee_id'=>$committee->id,'department_id'=>$delegate->department->id,'reason'=>'']) }}"
                       class="btn btn-sm btn-danger delete-row-delegate">
                        <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="font-weight:bold">
                اجمالى عددالمرشحين : <label id="delegatesNumber"
                                            style="font-weight:bold">{{ $delegates->count() }}</label>
            </td>
        </tr>

        </tbody>
    </table>
    <a onclick="window.history.back();" style="float: left;margin-right: 10px" class="btn btn-sm btn-primary">
        <i class="fa fa-step-backward"></i> {{ __('users::delegates.back') }}
    </a>

    <a id="btn-send-nomination" style="float: left;background-color: #057d54" class="btn btn-sm btn-info">
        <i class="fa fa-send"></i> {{ __('users::delegates.sendNomination') }}
    </a>
@endif
