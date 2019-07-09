<script>
    $(document).ready(function() {
            
        $(document).on('click', '.change_dept_order', function(){
            let currentIcon = $(this);
            let row = $(this).parents('tr:first');
            let backendURL   = $(this).attr('data-backend-url');
            let action = $(this).attr('data-action');

            $.ajax({
                url: backendURL,
                type: 'put',
                data: { action : action} ,

                success: function(response){
                    switch (action) {
                        case "up":
                            row.insertBefore(row.prev());
                        break;
                        default:
                            row.insertAfter(row.next());
                    }
                }
            });
        });
    
    });
</script>