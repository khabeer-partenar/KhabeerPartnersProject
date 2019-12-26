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
    });
</script>

