var language = {
  "sEmptyTable": "No data available in table",
  "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
  "sInfoEmpty": "Showing 0 to 0 of 0 entries",
  "sInfoFiltered": "(filtered from _MAX_ total entries)",
  "sInfoPostFix": "",
  "sInfoThousands": ",",
  "sLengthMenu": "Show _MENU_ entries",
  "sLoadingRecords": "Loading...",
  "sProcessing": "Processing...",
  "sSearch": "Search:",
  "sZeroRecords": "No matching records found",
  "oPaginate": {
    "sFirst": "First",
    "sLast": "Last",
    "sNext": "Next",
    "sPrevious": "Previous"
  },
  "oAria": {
    "sSortAscending": ": activate to sort column ascending",
    "sSortDescending": ": activate to sort column descending"
  }
};
if ($('#table-ajax').attr('data-url')) {
  var fields = jQuery.parseJSON($('#table-ajax').attr('data-fields'));
  var datatableFields = [];
  $(fields).each(function(i, v) {

    if (v.searchable == 'false') {
      datatableFields.push({
        title: v.title,
        data: v.data,
        searchable: false,
        sortable: false
      });
    } else {
      datatableFields.push({
        title: v.title,
        data: v.data,
        render: $.fn.dataTable.render.text()
      });
    }
  });

  $('#table-ajax').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: $('#table-ajax').attr('data-url'),
      type: 'get'
    },
    columns: datatableFields,
    order: [
      [0, "asc"]
    ],
    searchDelay: 500,
    "language": language
  });
}
if ($('#table')) {
  $('#table').DataTable({
    "language": language
  });
}

if ($('#table2')) {
  $('#table2').DataTable({
    "language": language
  });
}


if ($('#table5')) {
  $('#table5').DataTable({
    "language": language
  });
}

if ($('#table4')) {
  $('#table4').DataTable({
    "language": language
  });
}