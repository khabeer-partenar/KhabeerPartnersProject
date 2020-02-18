<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: $(this).attr('data-placeholder') ? $(this).attr('data-placeholder') : ''
        });

        $('.date-picker').datepicker({
            language: "ar"
        }).on('changeDate', function(e) {
            var helpBlockDiv = $(this).parent().find('.help-block');
            $(helpBlockDiv).remove();
            var formGroup = $(this).closest('.form-group');
            $(formGroup).removeClass('has-error');
        });

        $('#advisor_id').change(function () {
            let advisorId = $(this).val();
            $('select#participant_advisors option').each(function() {
                let optionVal = $(this).val();
                if (advisorId == optionVal) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
            $('#participant_advisors').select2();
        });

        // Departments
        $('#addDepartmentToParticipants').click(function () {
            let departmentsBody = $('#departmentsTableBody');
            let selectedOption = $('#departments').find(":selected")[0];
            const val = $(selectedOption).val();
            const text = $(selectedOption).text();
            if (selectedOption && !$(selectedOption).is(":disabled") && val != 0) {
                let trow = `
                    <tr class="trow" id="trow-${val}">
                      <th scope="row">
                         ${text}
                         <input name="departments[${val}]" hidden value="${val}">
                         <input name="text[${val}]" hidden value="${text}">
                      </th>
                      <td><input name="departments[${val}][nomination_criteria]" class="nomination_criteria"></td>
                      <td><button type="button" class="btn btn-danger trow-remove" data-id="${val}" data-remove-row="#trow-${val}">حذف</button></td>
                    </tr>
                `;
                $(departmentsBody).append(trow);
                $(selectedOption).prop('disabled', true);
                //$('.select2').select2();
            }
        });

        $(document).on('click', '.trow-remove', function () {
            const row = $(this).attr('data-remove-row');
            const departmentId = $(this).attr('data-id');
            const option = $('#departments').find('option[value="' + departmentId + '"]')[0];
            $(row).remove();
            $(option).prop('disabled', false);
            $('.select2').select2();
        });

        // Files
        $(document).on('click', '#upload-file', function () {
            let uploadBtn = $('#upload-file-browse');
            $(uploadBtn).trigger('click');
        });

        $(document).on('change', '#upload-file-browse', function () {
            const fileName = $(this).val().replace(/^.*\\/, "");
            $('#fileName').html(fileName);
        });

        $(document).on('click', '#saveFiles', function () {
            let btn = $(this);
            let uploadBtn = $('#upload-file-browse');
            let nextOrder = parseInt($(btn).attr('data-order')) + 1;
            let formData = new FormData();
            $.each($(uploadBtn)[0].files, function (i, file) {
                formData.append('file', file);
            });
            formData.append('description', $('[name=file_description]').val());
            let url = $(this).data('url');
            $.post({
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    const document = response.document;
                    let trow = `
                    <tr id="file-${document.id}">
                        <td>${nextOrder}</td>
                        <td>${document.description ? document.description : ''}</td>
                        <td>
                            <a href="${document.full_path}">${document.name}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                             data-remove-url="${response.delete_url}"
                             data-remove-row="#file-${document.id}">
                                حذف
                            </button>
                        </td>
                    </tr>
                    `;
                    $('#files').append(trow);
                    $('[name=file_description]').val('');
                    $('#upload-file-browse').val('');
                    $('#fileName').html('');
                    $(btn).attr('data-order', nextOrder);
                },
                error: function (request) {
                    let errors = request.responseJSON.errors;
                    let keys = Object.keys(errors);
                    Swal.fire({
                        title: 'حدث خطأ',
                        text: errors[keys[0]][0], // First Error is enough
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'حسنا',
                    });
                }
            })
        });

        $(document).on('click', '.file-remove', function () {
            let btn = $(this);
            let url = $(btn).attr('data-remove-url');
            $.post({
                url: url,
                method: 'delete',
                success: function (response) {
                    let trow = $(btn).attr('data-remove-row');
                    $(trow).remove();
                },
                error: function (request) {
                    let errors = request.responseJSON.errors;
                    let keys = Object.keys(errors);
                    Swal.fire({
                        title: 'حدث خطأ',
                        text: errors[keys[0]][0], // First Error is enough
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'حسنا',
                    });
                }
            })
        })

        // On Submit
        $("#save-committee").click(function (e) {
            e.preventDefault();
            let participantAdvisors = $('#participant_advisors').val();
            if (!participantAdvisors) {
                $('#committee-form').append("<input name='participant_advisors[]' hidden>")
            }
            setTimeout(function () {
                $('#committee-form').submit();
            }, 400);
        });

        $(document).on('click', '#btn-send-nomination', function () {

            var url = '{{(isset($committee))? route("committees.send.nomination",compact("committee")):''}}';
            if (url == '') return;
            Swal.fire({
                title: 'هل تريد إرسال الترشيحات الى سكرتير المستشار؟',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#337ab7',
                cancelButtonColor: '#ed6b75',
                confirmButtonText: 'موافق',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            console.log(result);
                            if (result.status == true) {
                                Swal.fire({
                                    title: result.msg,
                                    type: 'info',
                                    confirmButtonText: 'حسنا'
                                })
                                window.location.href = '{{ url("committees")}}';
                            } else {
                                Swal.fire({
                                    title: result.msg,
                                    type: 'error',
                                    confirmButtonText: 'حسنا'
                                })
                            }

                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(data);
                            Swal.fire({
                                title: 'لم يتم ارسال الترشيح',
                                type: 'error',
                                confirmButtonText: 'حسنا'
                            })
                        }


                    });
                }
            })


        });

        $(document).on('click', '#btn-approve', function () {

            var url = '{{(isset($committee))? route("committees.approve",compact("committee")):''}}';
            if (url == '') return;
            Swal.fire({
                title: 'هل تريد اعتماد اللجنة؟',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#337ab7',
                cancelButtonColor: '#ed6b75',
                confirmButtonText: 'موافق',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            Swal.fire({
                                title: 'تم الاعتماد بنجاح',
                                type: 'info',
                                confirmButtonText: 'حسنا'
                            })
                            window.location.href = '{{ url("committees")}}';


                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(data);
                            Swal.fire({
                                title: 'لم يتم الاعتماد',
                                type: 'error',
                                confirmButtonText: 'حسنا'
                            })
                        }


                    });
                }
            })


        });
    });

</script>

