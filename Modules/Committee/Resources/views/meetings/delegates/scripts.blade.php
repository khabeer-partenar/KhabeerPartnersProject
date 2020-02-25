<script>

    $(document).ready(function () {

        $('#btnAddMedia').click(function () {
            $html = '{{ Form::textarea('text[]', null, ['maxlength' => 191, 'rows' => 2, 'cols' => 54,'style'=>'width:100%'])}}';
            $html +='<hr style="margin-top: 5px;margin-bottom: 5px">';
            $('#btnAddMedia').before($html);
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

        $(document).on('click', '#OptioinAccept', function () {
            $("#refuse_reason").prop("disabled",true);
        })

        $(document).on('click', '#optionApologize', function () {
            $("#refuse_reason").prop("disabled",false);
        });

        $(document).on('click', '#saveDelegateDriver', function () {
            let btn = $(this);
            let formData = $('#addDriverForm').serialize();
            let url = $(this).data('url');
            const driver_id = $('#driver_id').val();
            $.post({
                url: url,
                data: formData,
                success: function (response) {
                    const driver = response.driver;
                    const religion = response.religion;
                    const nationality = response.nationality;
                    $('#addDelegateModal').modal('hide')
                    let trow = `
                    <tr>
                        <td>${driver.name }</td>
                        <td>${driver.national_id }</td>
                        <td>${driver.nationality.name }</td>
                        <td>${driver.religion.name }</td>
                        
                    </tr>
                    `;
                    $('#driverid').val(driver.id);
                    $('#drivers').html(trow);
                    $('[name=name]').val('');
                    $('[name=nationality]').val('');
                    $('').html('');
                },
                error: function (request) {
                    $('#addDelegateModal').modal('hide')

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

        //delegate files
        $(document).on('click', '#saveDelegateFiles', function () {
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
                    const delegateDocument = response.delegateDocument;
                    let trow = `
                    <tr id="file-${delegateDocument.id}">
                        <td>${nextOrder}</td>
                        <td>${delegateDocument.description ? delegateDocument.description : ''}</td>
                        <td>
                            <a href="${delegateDocument.full_path}">${delegateDocument.name}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                             data-remove-url="${response.delete_url}"
                             data-remove-row="#file-${delegateDocument.id}">
                                حذف
                            </button>
                        </td>
                    </tr>
                    `;

                    $('#filesOfDelegate').append(trow);
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

        $('#driver_id').select2({
            ajax: {
                url: '/committees/drivers',
                dataType: 'json',
                delay: 300,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
            },
            width: '100%',
            minimumInputLength: 3,
        });

        $(document).on('click', '#getDelegateDrivers', function () {
            let formData = $('#driver_id').serialize();
            const url = $(this).attr('data-url');
            const driver_id = $('#driver_id').val();


            $.get({
                url: url,
                data: {'driver_id':driver_id},
                success: function (response) {
                    const driver = response.driver;
                    let trow = '';
                        trow = `
                            <tr>
                                <td>${driver.name }</td>
                                <td>${driver.national_id }</td>
                                <td>${driver.nationality.name }</td>
                                <td>${driver.religion.name }</td>
                            </tr>
                    `;
                     $('#driverid').val(driver.id);
                     $('#drivers').html(trow);
                    var s =  $('#driverid').val(driver.id);
                }

            });
        });

        $(document).on('click', '.file-remove-delegate', function () {
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

        $('#optionApologize').click(function() {
            if( $(this).is(':checked')) {
                $("#drivers_of_delegate").hide();
            } else {
                $("#drivers_of_delegate").show();
            }
        }); 
        $('#OptioinAccept').click(function() {
            if( $(this).is(':checked')) {
                $("#drivers_of_delegate").show();
            } else {
                $("#drivers_of_delegate").hide();
            }
        });

        $('#addDelegateModal').on('hidden.bs.modal', function () {
            $('#driver_name').val('');
            $('#driver_nationality_id').val('');
            $('#driver_national_id').val('');
            $('#driver_religion_id').val('0');
        })


    });

</script>
