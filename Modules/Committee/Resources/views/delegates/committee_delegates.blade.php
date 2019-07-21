{{-- committee delegates --}}
<p class="underLine">{{ __('committee::committees.delegates_title') }}</p>

<table class="table table-striped table-responsive-md">
    <thead>
    <tr>
        <th style="width: 16.666%" scope="col"></th>
        <th scope="col">{{ __('committee::committees.delegates_department') }}</th>
        <th scope="col">{{ __('committee::committees.delegate_name') }}</th>
        <th scope="col">{{ __('committee::committees.delegate_national_id') }}</th>
        <th scope="col">{{ __('committee::committees.delegate_phone') }}</th>
        <th scope="col">{{ __('committee::committees.delegate_email') }}</th>
        <th scope="col">{{ __('committee::committees.delegate_options') }}</th>

    </tr>
    </thead>
    <tbody>
    @foreach($committee->delegates as $delegate)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>
            {{ $delegate->direct_department_id }}
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
            <button class="btn btn-danger">{{__('committee::committees.delegate_delete')}}</button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>