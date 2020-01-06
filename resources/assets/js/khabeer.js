$(document).ready(function() {
    // Setup Ajax to use CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Delete row in dataTable
    $(document).on('click', '.delete-row', function () {
        let btn = $(this);
        let path = $(this).attr('data-href');
        let table = $('#table-ajax').DataTable();

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
                        table.row(btn.parents('tr')).remove().draw();
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

    // Delete a row in dataTable with a reason
    $(document).on('click', '.delete-row-reason', function () {
        let btn = $(this);
        let path = $(this).attr('data-href');
        let table = $('#table-ajax').DataTable();

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
            cancelButtonColor: '#d6a329',
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

                    success: function (response) {
                        table.row(btn.parents('tr')).remove().draw();
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

    $('.datetime-picker').datetimepicker({
        rtl: true,
        format: 'd/m/Y H:i',
    });

    // users search using select 2
    $('.select2-search-employees').select2({
        ajax: {
            url: "/users/employees/search-by-name",
            dataType: 'json',
            delay: 500,
            data: function (params) {
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
            data: function (params) {
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
        if ($(this).val() != 0) {
            $.ajax({
                url: path,
                success: function (response) {
                    let select = $(child)[0];
                    let length = Object.keys(response).length;
                    for (let index = 0; index < length; index++) {
                        select.options[select.options.length] = new Option(response[index].name, response[index].id);
                    }
                    let children = $(select).children();
                    for (let index = 0; index < length; index++) {
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

    // Check all in a container
    $(document).on('change', '.checkInContainer', function () {
        var checked = $(this).prop('checked');
        var target = $(this).attr('data-container');
        var checkboxes = $(target).find(':checkbox');
        checkboxes.each(function () {
            $(this).prop('checked', checked);
        });
    });

    // Uncheck all checkbox auto
    $(document).on('change', '.containerUnCheckAll', function () {
        var checked = $(this).prop('checked');
        var target = $(this).attr('data-checker');
        var isAllChecked = $(target).prop('checked');
        if (!checked && isAllChecked) {
            $(target).prop('checked', false);
        }
    });

    $('#menu').slicknav({
        label: '',
        duplicate: true
    });

    $(window).scroll(function () {
        // go to top
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }

        // fixed menu
        if ($(this).scrollTop() > 112) {
            $('.top_menu').addClass('fixed');
        } else {
            $('.top_menu').removeClass('fixed');
        }
    });
});