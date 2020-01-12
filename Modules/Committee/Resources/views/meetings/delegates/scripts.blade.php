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

        $(document).on('click', '#OptioinAccept', function () {
            $("#refuse_reason").prop("disabled",true);
        })

        $(document).on('click', '#optionApologize', function () {
            $("#refuse_reason").prop("disabled",false);
        });
    });

</script>
