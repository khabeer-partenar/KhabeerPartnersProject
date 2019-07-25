<script>
    $(document).ready(function () {

        $('.select2').select2({
            dropdownParent:$("#addDelegateModal"),
            width: '100%'
        });

        //$('.select2').select2();
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

        $(document).on('submit', 'form#delegate-form', function (event) {
            event.preventDefault();
            var form = $(this);
            var data = new FormData($(this)[0]);
            console.log(data);
            var url = form.attr("action");
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.is-invalid').removeClass('has-error');
                    console.log(data);
                    /*if (data.fail) {
                        for (control in data.errors) {
                            $('input[name=' + control + ']').addClass('is-invalid');
                            $('#error-' + control).html(data.errors[control]);
                        }
                    } else {
                        $('#modalForm').modal('hide');
                        ajaxLoad(data.redirect_url);
                    }*/
                },
                error: function (xhr, textStatus, errorThrown) {
                    //alert("Error: " + errorThrown);
                }
            });
            return false;
        });

    });



</script>