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
                        $(btn).parent().parent().remove();
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

    $(document).on('click', '.delete-row-reason', function(){
        let btn = $(this);
        let path = $(this).attr('data-href');

        // const { value: reason } = await

        Swal.fire({
            title: 'هل انت متأكد من عملية الحذف؟',
            type: 'warning',
            input: 'text',
            inputPlaceholder: 'سبب الحذف',
            inputAttributes: {
                maxlength: 300,
            },
            showCancelButton: true,
            confirmButtonColor: '#ed6b75',
            cancelButtonColor: '#337ab7',
            confirmButtonText: 'حذف',
            cancelButtonText: 'إلغاء',
            inputValidator: (value) => {
                if (!value) {
                    return 'سبب الحذف مطلوب'
                }
            },
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: path,
                    data: {'reason': result.value},
                    type: 'delete',

                    success: function(response){
                        $(btn).parent().parent().remove();
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
        });
        // console.log(reason);
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

    // load departments in other select
    $('.load-departments').change(function () {
        let path = $(this).attr('data-url') + '?parentId=' + $(this).val();
        let child = $(this).attr('data-child');
        // Empty Children
        $(child).empty();
        $('#department_reference').val('');
        $('#department_reference_val').val('');
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
                    let children = $(select).children();
                    for(let index = 0; index < length; index++) {
                        if (response[index].reference_department) {
                            $(children[index]).attr('data-ref-id', response[index].reference_department.id);
                            $(children[index]).attr('data-ref-name', response[index].reference_department.name);
                        }
                        $(children[index]).attr('data-is-ref', response[index].is_reference);
                    }
                }
            });
        }
    });

    // Remove Error when changing Values
    $('input').not(".date-picker").change(function () {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $('select').change(function () {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });
});