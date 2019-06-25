<script>
    $(document).ready(function () {
        $('.select2').select2();
        // Load Department
        $('.load-departments').change(function () {
            let path = $(this).attr('data-url') + '?parentId=' + $(this).val();
            let child = $(this).attr('data-child');
            // Empty Children
            $(child).empty();
            if ($(child).hasClass('load-departments')) {
                let childOfChild = $(child).attr('data-child');
                $(childOfChild).empty();
            }
            if ($(this).val() != 0){
                $.ajax({
                    url: path,
                    success: function (response) {
                        let select = $(child)[0];
                        let length = Object.keys(response).length;
                        for (let index = 0; index < length; index++) {
                            select.options[select.options.length] = new Option(response[index].name, response[index].id);
                        }
                    }
                });
            }
        });
    });
</script>