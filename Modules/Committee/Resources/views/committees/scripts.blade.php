<script>
    $(document).ready(function () {
        $('.select2').select2();

        $('.date-picker').datepicker({
            language: "ar"
        });

        $('#addDepartmentToParticipants').click(function () {
            let departmentsBody = $('#departmentsTableBody');
            let selectedOption = $('#departments').find(":selected")[0];
            const val = $(selectedOption).val();
            const text = $(selectedOption).text();
            if (selectedOption && !$(selectedOption).is(":disabled")  && val != 0) {
                let trow = `
                    <tr class="trow" id="trow-${val}">
                      <th scope="row">
                         ${text}
                         <input name="departments[${val}]" hidden value="${val}">
                      </th>
                      <td><input name="departments[${val}][nomination_criteria]" class="nomination_criteria"></td>
                      <td><button type="button" class="btn btn-danger trow-remove" data-id="${val}" data-remove-row="#trow-${val}">حذف</button></td>
                    </tr>
                `;
                $(departmentsBody).append(trow);
                $(selectedOption).prop('disabled', true);
            }
        });

        $(document).on('click', '.trow-remove', function () {
            const row = $(this).attr('data-remove-row');
            const departmentId = $(this).attr('data-id');
            const option = $('#departments').find('option[value="' + departmentId + '"]')[0];
            $(row).remove();
            $(option).prop('disabled', false);
        });
    });
</script>