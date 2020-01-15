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
                type: 'استكمالي',
                title: ' استكمال  اجتماع وزير النقل مع نوابه',
                start: '2020-01-20 01:20:00',
                end: '2020-01-20 03:10:00',
                color: '#000',
                meetingType:'استكمالي',
                meetingChair: 'ahmed farghaly',
                place: 'صالة المدينة المنورة',
                attendaceNumber: 10,
                absenceNumber: 1
            },
            {
                type: 'استكمالي',
                title: ' اجتماع رئيس الوزراء مع نوابه',
                start: '2020-01-11 16:20:00',
                end: '2020-01-11 19:30:00',
                color: '#ff9f89',
                meetingType:'اولي',
                meetingChair: 'ahmed farghaly',
                place: 'صالة الملك فهد',
                attendaceNumber: 15,
                absenceNumber: 8
            },
            

        ]
        });

        calendar.render();
        $('.fc-content').click(function () {
            $(this).data('title') !== null ? $("#title_data").text($(this).data('title')):'';
            $(this).data('start') !== null ? $("#from_data").text(handleTime($(this).data('start'))):'';
            $(this).data('end') !== null ? $("#to_data").text(handleTime($(this).data('end'))):'';
            $(this).data('meeting-chair') !== null ? $("#chairman_data").text($(this).data('meeting-chair')):'';
            $(this).data('meeting-place') !== null ? $("#room_data").text($(this).data('meeting-place')):'';
            $(this).data('meeting-absence-number') !== null ? $("#absence_data").text($(this).data('meeting-absence-number')):'';
            $(this).data('meeting-attendace-number') !== null ? $("#attendace_data").text($(this).data('meeting-attendace-number')):'';
            $(this).data('meeting-type') !== null ? $("#type_data").text($(this).data('meeting-type')):'';
        });
        function handleTime(dateTime)
        {
            moment.locale('ar-sa');
            time = moment(dateTime).subtract(3,'hours').format('LT');
            return time;
        }

    
    });
</script>

