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
    <tbody id="delegatesTable">
    @foreach($delegates as $delegate)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
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
                <a data-href="{{ route('delegate.remove.from.committee',['delegate'=>$delegate,'committee_id'=>$committee->id,'department_id'=>$delegate->department->id]) }}"  class="btn btn-sm btn-danger delete-row-delegate">
                    <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--<script>
    jQuery(document).ready(function () {
        jQuery('#sharecomment').click(function (e) {
            e.preventDefault();
            jQuery.ajax({
                url: "{{ url('/comments/store') }}",
                method: 'post',
                data: {
                    comment: jQuery('#comment').val(),
                    post_id: jQuery('#post_id').val(),
                    user_id: jQuery('#user_id').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    console.log(result);
                    window.location.reload();
                }
            });
        });
    });
</script>--}}

