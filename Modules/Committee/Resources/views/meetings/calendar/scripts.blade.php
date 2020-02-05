<script>
    $(document).ready(function () {
        // Calendar
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
            buttonIcons: false, // show the prev/next text
            navLinks: false, // can click day/week names to navigate views

            events: {
                startParam:'from',
                endParam:'to',
                url: '{{route('meetings.calendar.ajax')}}',
                failure: function() {
                //document.getElementById('script-warning').style.display = 'block'
                }
            },
        });

            calendar.render();

            $(document).on('click', '.fc-content', function(){
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
        function format(meetings) {
            var events = [];
            for(var i = 0; i < meetings.length ; i++) {
                events[i] = {
                    meetingType: meetings[i].type.name,
                    title: meetings[i].reason,
                    start: meetings[i].from_date,
                    end: meetings[i].to_date,
                    color: meetings[i].type.color ? meetings[i].type.color:'#009247',
                    meetingChair: meetings[i].advisor.name,
                    place: meetings[i].room.name,
                    attendaceNumber: (meetings[i].attending_delegates).length + (meetings[i].attending_advisors).length,
                    absenceNumber: (meetings[i].absent_delegates).length + (meetings[i].absent_advisors).length
                };
            }
            return events;
        }
    
    });
</script>
