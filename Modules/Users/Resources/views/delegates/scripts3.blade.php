<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '.manage-delegate-delete', function () {
            let btn = $(this);
            let path = $(this).attr('data-href');
            //let table = $('#table-ajax').DataTable();

            Swal.fire({
                title: 'هل انت متأكد من عملية الحذف؟',
                text: "لن يمكنك الرجوع عن العملية",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ed6b75',
                cancelButtonColor: '#d6a329',
                confirmButtonText: 'حذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {

                if (result.value) {
                    $.ajax({
                        url: path,
                        type: 'delete',

                        success: function (response) {
                            if (response.status)
                            {
                                Swal.fire({
                                    title: 'حدث خطأ',
                                    text: response.msg,
                                    type: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#D3D3D3',
                                    confirmButtonText: 'حسنا',
                                });
                            }
                            else {
                                location.reload();
                            }
                        },

                        error: function (request, status, error) {
                            Swal.fire({
                                title: 'حدث خطأ',
                                text: request.responseJSON.msg,
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#D3D3D3',
                                confirmButtonText: 'حسنا',
                            });
                        }
                    });
                }
            })
        });
    });
</script>