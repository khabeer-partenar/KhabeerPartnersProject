<script>
    $(document).ready(function () {

        $('.select2').select2({
            dropdownParent: $("#addDelegateModal"),
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
        $("#co-form").submit(function () {
            $('#job_role_id').prop('disabled', false);
            setTimeout(function () {
                $(this).submit();
            }, 1000);
        });

        $(document).on('submit', 'form#delegate-form-create', function (event) {
            event.preventDefault();
            $("#job_role_id").prop('disabled', false);
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
                    $('.has-error').removeClass('has-error');

                    //console.log(data);
                    $("#job_role_id").prop('disabled', true);

                    $('#addDelegateModal').modal('hide');
                    location.reload();
                },
                error: function (request) {
                    let errors = request.responseJSON.errors;
                    let keys = Object.keys(errors);
//console.log(errors[0]);
                    for (index = 0; index < keys.length; ++index) {
                        $('#div_' + keys[index]).addClass('has-error');
                        $('#span_' + keys[index]).text(errors[keys[index]]);
                        console.log(keys[index]);
                        console.log(errors[keys[index]]);
                    }
                    $("#job_role_id").prop('disabled', true);
                    //console.log(errors[]);
                    //let keys = Object.keys(errors);
                    //alert("Error: " + errohrown);
                }
            });
            return false;
        });

    });


</script>


<script>
    // open popup to nominate delegates
    $(document).ready(function () {
        $(".nominateBtn").click(function () {
            @if (count($delegatesQuery) > 0)


                $("#nominationsListModal").modal();
            @else
                Swal.fire({
                    title: 'لا يوجد مندوبين لهذه الجهة من فضلك قم باضافة مندوب جديد',
                    type: 'error',
                    confirmButtonText: 'موافق'
                })
            @endif
        });
    });

    function getDelegates() {
            var data = new FormData($(this)[0]);
            console.log(data);
            var url = form.attr("action");


            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.has-error').removeClass('has-error');

                    //console.log(data);
                    $("#job_role_id").prop('disabled', true);

                    $('#addDelegateModal').modal('hide');
                    location.reload();
                },
                error: function (request) {
                    let errors = request.responseJSON.errors;
                    let keys = Object.keys(errors);
//console.log(errors[0]);
                    for (index = 0; index < keys.length; ++index) {
                        $('#div_' + keys[index]).addClass('has-error');
                        $('#span_' + keys[index]).text(errors[keys[index]]);
                        console.log(keys[index]);
                        console.log(errors[keys[index]]);
                    }
                    $("#job_role_id").prop('disabled', true);
                    //console.log(errors[]);
                    //let keys = Object.keys(errors);
                    //alert("Error: " + errohrown);
                }
            });

    }
</script>