<script>
    $(document).ready(function () {
        var initialLocaleCode = 'ar-sa';
        var localeSelectorEl = document.getElementById('locale-selector');
        var calendarEl = document.getElementById('calendar');
        var startDate ='';
        var endDate  = '';
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            locale: initialLocaleCode,
            buttonIcons: false, 
            navLinks: false, 

            events: {
                startParam:'from',
                endParam:'to',
                url: '{{route('meetings.calendar.ajax')}}',
                failure: function() {
                    Swal.fire({
                        title: 'حدث خطأ',
                        text: 'اثناء عرض الاحتماعات', // First Error is enough
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'حسنا',
                    });
                }
            },
        });

            calendar.render();
            $(document).on('click', '.fc-content', function(){
            $(this).data('title') !== null ? $("#title_data").text($(this).data('title')):'';
            $(this).data('start') !== null ? $("#from_data").text(handleTime($(this).data('start'))):'';
            $(this).data('end') !== null ? $("#to_data").text(handleTime($(this).data('end'))):'';
            $(this).data('meeting-place') !== null ? $("#room_data").text($(this).data('meeting-place')):'';
            $(this).data('meeting-type') !== null ? $("#type_data").text($(this).data('meeting-type')):'';
            $(this).data('url') !== null ? $("#meeting_details").attr('href',$(this).data('url')):'';
            if($(this).data('meeting-chair') !== null  && $(this).data('advisor-id') !== $(this).data('user-id'))
                $("#chairman_data").text($(this).data('meeting-chair'));
            else
                $('#chairman_content').remove();

            if($(this).data('user-type') == 'delegate')
            {
                $('#absence_data_row').remove();
                $('#attendace_data_row').remove();
                $('#inviting_status').text($(this).data('user-status'));
            }
            else
            {
                $('#inviting_status_row').remove();
                $(this).data('meeting-absence-number') !== 0 ? $("#absence_data").text(persianJs($(this).data('meeting-absence-number')).englishNumber()):$("#absence_data").text('٠');
                $(this).data('meeting-attendace-number') !== 0 ? $("#attendace_data").text(persianJs($(this).data('meeting-attendace-number')).englishNumber()):$("#attendace_data").text('.');
            }

        });


        function handleTime(dateTime)
        {
            moment.locale('ar-sa');
            time = moment(dateTime).subtract(3,'hours').format('LT');
            return time;
        }
    
    });
</script>
