$(document).ready(function() {

  /* Delete object Modal */
  $('.delete-object-modal-table').on('click', '.delete-object-modal-button', function(e) {
    e.preventDefault();

    var r = confirm('هل انت متأكد من الحذف؟');

    if (r == true) {
      var form = $(this).parents('form:first');
      form.submit();
    }
  });

  $('.yes-no-submit-button-form').on('click', function(e) {
    e.preventDefault();

    var r = confirm('هل انت متأكد من الحذف؟');

    if (r == true) {
      var form = $(this).parents('form:first');
      form.submit();
    }
  });


  $('.confirm-message').on('click', function(e) {
      return confirm('هل انت متأكد؟');
  });


  /* Multi input */
  $(".add-more").click(function() {
    var html = $(".copy").html();
    $(".after-add-more").after(html);
  });

  $("body").on("click", ".remove", function() {
    $(this).parents(".control-group").remove();
  });


  /* Hijri Date Picker */
  var hijriCalendar = $.calendars.instance('ummalqura', 'ar');
  $('.hijri-datepicker-input').calendarsPicker({
    calendar: hijriCalendar,
    dateFormat: 'yyyy-mm-dd'
  });

  /* Miladi Date Picker */
  var calendar = $.calendars.instance();
  $('.en-datepicker-input').calendarsPicker({
    calendar: calendar,
    dateFormat: 'yyyy-mm-dd'
  });

$(".select2-user-select").select2({
  minimumInputLength: 3,
  ajax: {
    url: "/core/users/search",
    data: function (params) {
      var query = {
        query: params.term
      }
      // Query parameters will be ?search=[term]&type=public
      return query;
    },
    processResults: function (data) {
      var users = [];
      users.push({ id: "null" , text: lodashLib.get(window.i18n, 'messages.not_exist') });
      for (let i = 0; i < data.length; i++) {
        users.push({ id: data[i].user_id , text: data[i].user_name });
      }
      //console.log(users);
      // Tranforms the top-level key of the response object from 'items' to 'results'
      return {
        results: users
      };
    }
  }
});

$(".select2-my-employee-search-select").select2({
  minimumInputLength: 3,
  ajax: {
    url: "/department-services/authorization/search",
    data: function (params) {
      var query = {
        query: params.term,
        organization_id: $("#organization_id").val(),
      }
      // Query parameters will be ?search=[term]&type=public
      return query;
    },
    processResults: function (data) {
      var employees = [];
      employees.push({ id: "null" , text: lodashLib.get(window.i18n, 'messages.not_exist') });
      for (let i = 0; i < data.length; i++) {
        employees.push({ id: data[i].employee_id , text: data[i].arabic_name + ' - ' + data[i].employee_id });
      }
      //console.log(employees);
      // Tranforms the top-level key of the response object from 'items' to 'results'
      return {
        results: employees
      };
    }
  }
});


$(".select2-pmo-employee-search-select").select2({
    minimumInputLength: 3,
    ajax: {
      url: "/pmo/follow-need-requests/employee-search",
      data: function (params) {
        var query = {
            name: params.term,
            department_id: $("#department_id").val(),
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      processResults: function (data) {
        var employees = [];
        employees.push({ id: "null" , text: lodashLib.get(window.i18n, 'messages.not_exist') });
        for (let i = 0; i < data.length; i++) {
          employees.push({ id: data[i].employee_id , text: data[i].arabic_name + ' - ' + data[i].employee_id });
        }
        //console.log(employees);
        // Tranforms the top-level key of the response object from 'items' to 'results'
        return {
          results: employees
        };
      }
    }
});

$(".select2-booking-exams-employee-search-select").select2({
    minimumInputLength: 3,
    ajax: {
      url: "/bookingexams/colleges-map/employee-search",
      data: function (params) {
        var query = {
            name: params.term
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      processResults: function (data) {
        var employees = [];
        employees.push({ id: "null" , text: lodashLib.get(window.i18n, 'messages.not_exist') });
        for (let i = 0; i < data.length; i++) {
          employees.push({ id: data[i].employee_id , text: data[i].arabic_name });
        }
        //console.log(employees);
        // Tranforms the top-level key of the response object from 'items' to 'results'
        return {
          results: employees
        };
      }
    }
});

$("#np-extensions-export-to-excel").click(function() {
  $('<input />').attr('type', 'hidden')
        .attr('name', "export")
        .attr('value', "1")
        .attr('id', "export-to-excel-input-flag")
        .appendTo('#np-manage-extensions-search');
});

$("#np-extensions-search-button").click(function() {
  $('#export-to-excel-input-flag').remove();
});

// Get and set vacation days

var hijriCalendar = $.calendars.instance('ummalqura', 'ar');
$('#vacation-start-hijri-date').calendarsPicker({
  calendar: hijriCalendar,
  dateFormat: 'yyyy-mm-dd',
  onSelect: function(dates) {
    setVacationDates();
  }
});

$('#attendance-vacation-number-of-days').on('change', function() {
  setVacationDates();
})

$('#select-vacation-code').on('change', function() {

  var url = $('#select-vacation-code').attr('get-balance-url') +  "?vacation_code=" + $(this).val();

  axios.get(url).then(response => {
    $('#attendance-vacation-balance').val(response.data.balance);
    $('.loading-icon').css('display', 'none');
  }).catch(errors => {
    $('.loading-icon').css('display', 'none');
  });
})


function setVacationDates() {
  var url = $('#vacation-start-hijri-date').attr('get-vacation-dates-url');
  var hijriStartDate = $('#vacation-start-hijri-date').val();
  var numberOfDays = $("#attendance-vacation-number-of-days").val();

  url += "?start_hijri_date=" + hijriStartDate +
         "&number_of_days=" + numberOfDays;

  if (hijriStartDate != null && numberOfDays != null) {
    $('.loading-icon').css('display', 'inline');
    axios.get(url).then(response => {
      var days = response.data;
      $("#vacation-end-hijri-date").val(days.end_hijri_date);
      $("#vacation-start-miladi-date").val(days.start_miladi_date);
      $("#vacation-end-miladi-date").val(days.end_miladi_date);
      $('.loading-icon').css('display', 'none');
    }).catch(errors => {
      $('.loading-icon').css('display', 'none');
    });
  }
}
$('#absence-vacation-start-hijri-date').calendarsPicker({
    calendar: hijriCalendar,
    dateFormat: 'yyyy-mm-dd',
    onSelect: function onSelect(dates) {
      setAttendanceVacationDates();
    }
  });

  $('#attendance-vacation-period').on('change', function () {
    setAttendanceVacationDates();
  });

  function setAttendanceVacationDates() {
    var url = $('#absence-vacation-start-hijri-date').attr('get-dates-url');
    var hijriStartDate = $('#absence-vacation-start-hijri-date').val();
    var numberOfDays = $("#attendance-vacation-period").val();
    url += "?start_hijri_date=" + hijriStartDate + "&number_of_days=" + numberOfDays;

    if (hijriStartDate != null && numberOfDays != null) {
      axios.get(url).then(function (response) {
        var days = response.data;
        $("#attendance-vacation-end-hijri-date").val(days.end_hijri_date);
      });
    }
  }
});

$(document).ready(function() {
  $("#states").select2({
    placeholder: "اختر الطالبة",
    allowClear: true
  });

  $("#select-client-select2").select2({
    placeholder: 'إختر المقاول',
    allowClear: true
  });
});

$(document).ready(function() {
  $(".select-employee-task").select2({
    placeholder: "اختر موظف",
    allowClear: true
  });
});

$(document).ready(function() {
  $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
});

$(document).ready(function() {

  $("#popup-main-modal").modal('show');

  $("#clear-select2-selection").click(function(e) {
    e.preventDefault();
    $('#select2-user-select').val(null).trigger('change');

  });

});

$(document).ready(function() {
  //Housing Allowance Request
  var itemId = "#husband-or-wife-information";

  $( "#husband-or-wife-work-status-select" ).change(function() {
    if ($(this).val() == 1) {
      $(itemId).show();
    } else {
      $(itemId).hide();
    }
  });

  $val = $( "#husband-or-wife-work-status-select").val();

  if ($val != 1) {

    $(itemId).hide();
  }

  // Need Requests
  var inputId = "#need-request-comment-or-reason";

  $( "#need-request-actions" ).change(function() {

    if ($(this).val() == 2 || $(this).val() == 3 || $(this).val() == 11 || $(this).val() == 13 || $(this).val() == 14) {

      $(inputId).show();
      $('#need-request-approval-file').hide();
      $("#need-request-multi-dept-select").hide();

    } else if ($(this).val() == 10) {

      $('#need-request-approval-file').show();
      $(inputId).hide();

    } else if ($(this).val() == 6) {
      $("#need-request-multi-dept-select").show();
      $('#need-request-approval-file').hide();
      $(inputId).hide();

    } else {

      $('#need-request-approval-file').hide();
      $("#need-request-multi-dept-select").hide();
      $(inputId).hide();

    }

  });

  $val = $( "#need-request-actions").val();

  if ($val  == 2 || $val  == 3 || $val  == 11 || $val  == 13 || $val  == 14) {

    $(inputId).show();
    $('#need-request-approval-file').hide();
    $("#need-request-multi-dept-select").hide();

  } else if ($val == 10) {

    $('#need-request-approval-file').show();
    $("#need-request-multi-dept-select").hide();
    $(inputId).hide();

  } else if ($val == 6) {
    $("#need-request-multi-dept-select").show();
    $('#need-request-approval-file').hide();
    $(inputId).hide();

  }
   else {

    $('#need-request-approval-file').hide();
    $(inputId).hide();
    $("#need-request-multi-dept-select").hide();
  }

  // Ensure That all qty selected
  $('.need-request-select-qty-button-form').on('click', function(e) {
    e.preventDefault();

    var isAllInputsFilled = $(".need-request-selected-qty-input").filter(function () {
                              return $.trim($(this).val()).length == 0
                          }).length == 0;

    if (isAllInputsFilled) {

      var r = confirm(lodashLib.get(window.i18n, 'messages.are_you_sure'));

      if (r == true) {
        var form = $(this).parents('form:first');
        form.submit();
      }

    } else {
      var r = confirm('برجاء تحديد جميع الكميات');
    }
  });

});
