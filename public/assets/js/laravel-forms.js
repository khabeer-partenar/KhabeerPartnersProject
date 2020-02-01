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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/vendor/laravel-forms.js":
/*!*****************************************************!*\
  !*** ./resources/assets/js/vendor/laravel-forms.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Exemples :
<a href="posts/2" data-method="delete" data-token="{{csrf_token()}}">
- Or, request confirmation in the process -
<a href="posts/2" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?">
*/
(function () {
  var laravel = {
    initialize: function initialize() {
      this.methodLinks = $('a[data-method]');
      this.token = $('a[data-token]');
      this.registerEvents();
    },
    registerEvents: function registerEvents() {
      this.methodLinks.on('click', this.handleMethod);
    },
    handleMethod: function handleMethod(e) {
      var link = $(this);
      var httpMethod = link.data('method').toUpperCase();
      var form; // If the data-method attribute is not PUT or DELETE,
      // then we don't know what to do. Just ignore.

      if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
        return;
      } // Allow user to optionally provide data-confirm="Are you sure?"


      if (link.data('confirm')) {
        if (!laravel.verifyConfirm(link)) {
          return false;
        }
      }

      form = laravel.createForm(link);
      form.submit();
      e.preventDefault();
    },
    verifyConfirm: function verifyConfirm(link) {
      return confirm(link.data('confirm'));
    },
    createForm: function createForm(link) {
      var form = $('<form>', {
        'method': 'POST',
        'action': link.attr('href')
      });
      var token = $('<input>', {
        'type': 'hidden',
        'name': '_token',
        'value': link.data('token')
      });
      var hiddenInput = $('<input>', {
        'name': '_method',
        'type': 'hidden',
        'value': link.data('method')
      });
      return form.append(token, hiddenInput).appendTo('body');
    }
  };
  laravel.initialize();
})();

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/assets/js/vendor/laravel-forms.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

<<<<<<< HEAD
module.exports = __webpack_require__(/*! C:\Users\ahmed\Desktop\projects\KhabeerPartnersProject\resources\assets\js\vendor\laravel-forms.js */"./resources/assets/js/vendor/laravel-forms.js");
=======
module.exports = __webpack_require__(/*! C:\Users\DELL\Desktop\Projects\khabeer\resources\assets\js\vendor\laravel-forms.js */"./resources/assets/js/vendor/laravel-forms.js");
>>>>>>> 5637edfb50dded3f023eedf680cff9cdf56d1ebe


/***/ })

/******/ });