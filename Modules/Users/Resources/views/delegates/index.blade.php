<!-- Modal -->
<div style="margin-top: 10%" id="nominationsListModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="underLine">{{ __('users::delegates.title') }}</p>

            </div>
            <div class="modal-body">
                {{-- delegates --}}
                <table class="table table-striped table-responsive-md">
                    <thead>
                    <tr>
                        <th style="width: 16.666%" scope="col"></th>
                        <th scope="col">{{ __('users::delegates.department_name') }}</th>
                        <th scope="col">{{ __('users::delegates.delegate_name') }}</th>
                        <th scope="col">{{ __('users::delegates.national_id') }}</th>
                        <th scope="col">{{ __('users::delegates.phone_number') }}</th>
                        <th scope="col">{{ __('users::delegates.email') }}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                   {{-- @foreach($committee->participantDepartments as $department)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{ $department->name }}
                            </td>
                        </tr>
                    @endforeach--}}
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

