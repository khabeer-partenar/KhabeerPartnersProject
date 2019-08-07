<!-- Modal -->
<div id="nominationsListModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="underLine">{{ __('Users::delegates.title') }}</p>

            </div>
            <div class="modal-body">
                {{-- delegates --}}
                <table class="table table-striped table-responsive-md">
                    <thead>
                    <tr>
                        <th style="width: 16.666%" scope="col"></th>
                        <th scope="col">{{ __('Users::delegates.department_name') }}</th>
                        <th scope="col">{{ __('Users::delegates.delegate_name') }}</th>
                        <th scope="col">{{ __('Users::delegates.national_id') }}</th>
                        <th scope="col">{{ __('Users::delegates.phone_number') }}</th>
                        <th scope="col">{{ __('Users::delegates.email') }}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

