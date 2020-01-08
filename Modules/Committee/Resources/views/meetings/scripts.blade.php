<script>
    var initialLocaleCode = 'ar-sa';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');
    
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: $(this).attr('data-placeholder') ? $(this).attr('data-placeholder') : ''
        });

        $('.date-picker').datepicker({
            language: "ar",
            startDate: new Date()
        }).on('changeDate', function(e) {
            var helpBlockDiv = $(this).parent().find('.help-block');
            $(helpBlockDiv).remove();
            var formGroup = $(this).closest('.form-group');
            $(formGroup).removeClass('has-error');
        });

        $('[name=room_id]').change(function () {
            const val = $(this).val();
            if (val != 0) {
                $('#getRoomDetails').prop('disabled', false);
            } else {
                $('#getRoomDetails').prop('disabled', true);
            }
        });

        $('.timepicker').timepicker();

        $('#getRoomDetails').click(function () {
            const url = $(this).attr('data-url');
            const room_id = $('#room_id').val();
            $.ajax({
                url: url,
                data: {'room_id':room_id},
                success: function (response) {
                    const meetings = response.meetings;
                    let meetingsDiv = '';
                    for(let i = 0; i < meetings.length ; i++) {
                        meetingsDiv += `
                            <tr>
                                <td></td>
                                <td>${meetings[i].meeting_at_ar}</td>
                                <td>${meetings[i].from}</td>
                                <td>${meetings[i].to}</td>
                            </tr>
                    `;
                    }
                    $('#upcoming_meetings').html(meetingsDiv);
                    $('#room_name').html(response.name);
                    $('#room_city').html(response.city.name);
                    $('#room_capacity').html(response.capacity);
                    $('#roomDetailsModal').modal('show');
                }
            });
        });

        $('#roomDetailsModal').on('hidden.bs.modal', function() {
            $('#upcoming_meetings').empty();
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


        var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },
        locale: initialLocaleCode,
        buttonIcons: false, // show the prev/next text
        navLinks: false, // can click day/week names to navigate views
        events: [
            {
            title: 'اجتماع وزير النقل مع نوابه',
            start: '2020-01-08 16:00:00',
            color: '#ff9f89'
            },
            {
            title: ' استكمال  اجتماع وزير النقل مع نوابه',
            start: '2020-01-08 20:00:00',
            color: '#ff9f89'
            },
            {
            title: 'اجتماع وزير الصحة ووزير التعليم',
            start: '2020-01-20',
            end: '2019-08-13'
            },
            {
            title: 'تفقد وزير التعليم بعض مدارس المنطقة',
            start: '2020-02-12 10:30:00',
            end: '2020-02-12 12:30:00',
            color:'#154'
            },
            {
            title: 'عشاء عمل',
            start: '2020-01-28 20:00:00'
            },
            {
            title: 'توقيع اتفاقية التعاون المشترك',
            url: 'http://google.com/',
            start: '2020-02-05',
            color: '#162'
            }
        ]
        });

        calendar.render();
    });
</script>

