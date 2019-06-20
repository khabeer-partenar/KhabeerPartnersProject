$(document).ready(function() {

    // apply select2
    $('.select2').select2();


    // users search using select 2
    $('.select2-search-users').select2({
        ajax: {
            url: "/users/search-by-name",
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

});