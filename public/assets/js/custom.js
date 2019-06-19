/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/custom.js":
/*!***************************************!*\
  !*** ./resources/assets/js/custom.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  /* Delete object Modal */
  $('.delete-object-modal-table').on('click', '.delete-object-modal-button', function (e) {
    e.preventDefault();
    var r = confirm('هل انت متأكد من الحذف؟');

    if (r == true) {
      var form = $(this).parents('form:first');
      form.submit();
    }
  });
  $('.yes-no-submit-button-form').on('click', function (e) {
    e.preventDefault();
    var r = confirm('هل انت متأكد من الحذف؟');

    if (r == true) {
      var form = $(this).parents('form:first');
      form.submit();
    }
  });
<<<<<<< HEAD
=======
  $('.confirm-message').on('click', function (e) {
    return confirm('هل انت متأكد؟');
  });
>>>>>>> origin/master
  /* Multi input */

  $(".add-more").click(function () {
    var html = $(".copy").html();
    $(".after-add-more").after(html);
  });
  $("body").on("click", ".remove", function () {
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
      data: function data(params) {
        var query = {
          query: params.term // Query parameters will be ?search=[term]&type=public

        };
        return query;
      },
      processResults: function processResults(data) {
        var users = [];
        users.push({
          id: "null",
          text: lodashLib.get(window.i18n, 'messages.not_exist')
        });

        for (var i = 0; i < data.length; i++) {
          users.push({
            id: data[i].user_id,
            text: data[i].user_name
          });
        } //console.log(users);
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
      data: function data(params) {
        var query = {
          query: params.term,
          organization_id: $("#organization_id").val() // Query parameters will be ?search=[term]&type=public

        };
        return query;
      },
      processResults: function processResults(data) {
        var employees = [];
        employees.push({
          id: "null",
          text: lodashLib.get(window.i18n, 'messages.not_exist')
        });

        for (var i = 0; i < data.length; i++) {
          employees.push({
            id: data[i].employee_id,
            text: data[i].arabic_name + ' - ' + data[i].employee_id
          });
        } //console.log(employees);
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
      data: function data(params) {
        var query = {
          name: params.term,
          department_id: $("#department_id").val() // Query parameters will be ?search=[term]&type=public

        };
        return query;
      },
      processResults: function processResults(data) {
        var employees = [];
        employees.push({
          id: "null",
          text: lodashLib.get(window.i18n, 'messages.not_exist')
        });

        for (var i = 0; i < data.length; i++) {
          employees.push({
            id: data[i].employee_id,
            text: data[i].arabic_name + ' - ' + data[i].employee_id
          });
        } //console.log(employees);
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
      data: function data(params) {
        var query = {
          name: params.term // Query parameters will be ?search=[term]&type=public

        };
        return query;
      },
      processResults: function processResults(data) {
        var employees = [];
        employees.push({
          id: "null",
          text: lodashLib.get(window.i18n, 'messages.not_exist')
        });

        for (var i = 0; i < data.length; i++) {
          employees.push({
            id: data[i].employee_id,
            text: data[i].arabic_name
          });
        } //console.log(employees);
        // Tranforms the top-level key of the response object from 'items' to 'results'


        return {
          results: employees
        };
      }
    }
  });
  $("#np-extensions-export-to-excel").click(function () {
    $('<input />').attr('type', 'hidden').attr('name', "export").attr('value', "1").attr('id', "export-to-excel-input-flag").appendTo('#np-manage-extensions-search');
  });
  $("#np-extensions-search-button").click(function () {
    $('#export-to-excel-input-flag').remove();
  }); // Get and set vacation days

  var hijriCalendar = $.calendars.instance('ummalqura', 'ar');
  $('#vacation-start-hijri-date').calendarsPicker({
    calendar: hijriCalendar,
    dateFormat: 'yyyy-mm-dd',
    onSelect: function onSelect(dates) {
      setVacationDates();
    }
  });
  $('#attendance-vacation-number-of-days').on('change', function () {
    setVacationDates();
  });
  $('#select-vacation-code').on('change', function () {
    var url = $('#select-vacation-code').attr('get-balance-url') + "?vacation_code=" + $(this).val();
    axios.get(url).then(function (response) {
      $('#attendance-vacation-balance').val(response.data.balance);
      $('.loading-icon').css('display', 'none');
    })["catch"](function (errors) {
      $('.loading-icon').css('display', 'none');
    });
  });

  function setVacationDates() {
    var url = $('#vacation-start-hijri-date').attr('get-vacation-dates-url');
    var hijriStartDate = $('#vacation-start-hijri-date').val();
    var numberOfDays = $("#attendance-vacation-number-of-days").val();
    url += "?start_hijri_date=" + hijriStartDate + "&number_of_days=" + numberOfDays;

    if (hijriStartDate != null && numberOfDays != null) {
      $('.loading-icon').css('display', 'inline');
      axios.get(url).then(function (response) {
        var days = response.data;
        $("#vacation-end-hijri-date").val(days.end_hijri_date);
        $("#vacation-start-miladi-date").val(days.start_miladi_date);
        $("#vacation-end-miladi-date").val(days.end_miladi_date);
        $('.loading-icon').css('display', 'none');
      })["catch"](function (errors) {
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
$(document).ready(function () {
  $("#states").select2({
    placeholder: "اختر الطالبة",
    allowClear: true
  });
  $("#select-client-select2").select2({
    placeholder: 'إختر المقاول',
    allowClear: true
  });
});
$(document).ready(function () {
  $(".select-employee-task").select2({
    placeholder: "اختر موظف",
    allowClear: true
  });
});
$(document).ready(function () {
  $("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
});
$(document).ready(function () {
  $("#popup-main-modal").modal('show');
  $("#clear-select2-selection").click(function (e) {
    e.preventDefault();
    $('#select2-user-select').val(null).trigger('change');
  });
});
$(document).ready(function () {
  //Housing Allowance Request
  var itemId = "#husband-or-wife-information";
  $("#husband-or-wife-work-status-select").change(function () {
    if ($(this).val() == 1) {
      $(itemId).show();
    } else {
      $(itemId).hide();
    }
  });
  $val = $("#husband-or-wife-work-status-select").val();

  if ($val != 1) {
    $(itemId).hide();
  } // Need Requests


  var inputId = "#need-request-comment-or-reason";
  $("#need-request-actions").change(function () {
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
  $val = $("#need-request-actions").val();

  if ($val == 2 || $val == 3 || $val == 11 || $val == 13 || $val == 14) {
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
  } else {
    $('#need-request-approval-file').hide();
    $(inputId).hide();
    $("#need-request-multi-dept-select").hide();
  } // Ensure That all qty selected


  $('.need-request-select-qty-button-form').on('click', function (e) {
    e.preventDefault();
    var isAllInputsFilled = $(".need-request-selected-qty-input").filter(function () {
      return $.trim($(this).val()).length == 0;
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

/***/ }),

/***/ 2:
/*!*********************************************!*\
  !*** multi ./resources/assets/js/custom.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/abdullahalqduiry/Desktop/projects/un/KhabeerPartners/resources/assets/js/custom.js */"./resources/assets/js/custom.js");


/***/ })

/******/ });