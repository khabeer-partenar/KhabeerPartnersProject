$(document).ready(function() {

    // Setup Ajax to use CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    // Delete row in dataTable using Ajax
    $(document).on('click', '.delete-row', function(){
        let btn = $(this);
        let path = $(this).attr('data-href');
        Swal.fire({
            title: 'هل انت متأكد من عملية الحذف؟',
            text: "لن يمكنك الرجوع عن العملية",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ed6b75',
            cancelButtonColor: '#337ab7',
            confirmButtonText: 'حذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: path,
                    type: 'delete',
                    success: function(response){
                        console.log(response);
                        $(btn).parent().parent().remove();
                    }
                });
            }
        })
    });


    // apply select2
    $('.select2').select2();


    // users search using select 2
    $('.select2-search-employees').select2({
        ajax: {
            url: "/users/employees/search-by-name",
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    search: params.term
                };
            },
        },
        minimumInputLength: 3,
    });

    // select2 ajax search
    $('.select2-ajax-search').select2({
        ajax: {
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    search: params.term
                };
            },
        },
        minimumInputLength: 3,
    });


    // disable all form fields
    $('#diable-form-fields :input').prop('disabled', true);
});