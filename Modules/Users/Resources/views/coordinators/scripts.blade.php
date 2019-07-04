<script>
    $(document).ready(function () {
        $('.select2').select2();
        // Load Department
        $('.load-departments').change(function () {
            let path = $(this).attr('data-url') + '?parentId=' + $(this).val();
            let child = $(this).attr('data-child');
            // Empty Children
            $(child).empty();
            $('#department_reference').val('');
            $('#department_reference_val').val('');
            if ($(child).hasClass('load-departments')) {
                let childOfChild = $(child).attr('data-child');
                $(childOfChild).empty();
            }
            if ($(this).val() != 0){
                $.ajax({
                    url: path,
                    success: function (response) {
                        let select = $(child)[0];
                        let length = Object.keys(response).length;
                        for (let index = 0; index < length; index++) {
                            select.options[select.options.length] = new Option(response[index].name, response[index].id);
                        }
                        let children = $(select).children();
                        for(let index = 0; index < length; index++) {
                            if (response[index].reference_department) {
                                $(children[index]).attr('data-ref-id', response[index].reference_department.id);
                                $(children[index]).attr('data-ref-name', response[index].reference_department.name);
                            }
                            $(children[index]).attr('data-is-ref', response[index].is_reference);
                        }
                    }
                });
            }
        });
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
                    $('#job_role_id').select2();
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