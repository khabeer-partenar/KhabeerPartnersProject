var language = {
  "sProcessing": "جارٍ التحميل...",
  "sLengthMenu": "أظهر _MENU_ مدخلات",
  "sZeroRecords": "لم يعثر على أية سجلات",
  "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
  "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
  "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
  "sInfoPostFix": "",
  "sSearch": "ابحث:",
  "sUrl": "",
  "oPaginate": {
    "sFirst": "الأول",
    "sPrevious": "السابق",
    "sNext": "التالي",
    "sLast": "الأخير"
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