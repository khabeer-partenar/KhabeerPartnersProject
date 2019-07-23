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
                {{-- DataTable --}}
                <table id="table-ajax" class="table" data-url="{{ route('coordinators.index', [
                'name' => Request::input('name'),
                'main_department_id' => Request::input('main_department_id'),
                'parent_department_id' => Request::input('parent_department_id')
                ])
             }}"
                       data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},
                    {"data": "department_info","name":"actions","title":"{{ __('messages.department_info') }}","searchable":"false", "orderable":"false"},
                    {"data": "contact_options","name":"actions","title":"{{ __('messages.contact_options') }}","searchable":"false", "orderable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
                >
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

