$(document).ready(function() {

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


    // disable all form fields
    $('#diable-form-fields :input').prop('disabled', true);
});