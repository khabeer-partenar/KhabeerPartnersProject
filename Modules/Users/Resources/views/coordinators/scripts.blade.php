<script>
    $(document).ready(function () {
        // Change Reference input
        $(document).on('change', '.change-reference', function () {
            let selectedOption = $(this).find(":selected")[0],
            id = $(selectedOption).attr('data-ref-id'),
            name = $(selectedOption).attr('data-ref-name'),
            is_reference = $(selectedOption).attr('data-is-ref'),
            selectJobElm = $('#job_role_id')[0];
            for (let index = 0; index < selectJobElm.length; index++) {
                if ($(selectJobElm.options[index]).attr('data-main') == is_reference) {
                    $('#job_role_id').val($(selectJobElm.options[index]).val());
                    $('#job_role_id').select2({width: '100%'});
                }
            }

            $('#department_reference').val(id);
            $('#department_reference_val').val(name);
        });
        // On Submit
        $( "#co-form" ).submit(function() {
            $('#job_role_id').prop('disabled', false);
            setTimeout(function () {
                $(this).submit();
            }, 1000);
        });
    });
</script>