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
/******/ 	return __webpack_require__(__webpack_require__.s = 31);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/c3.init.js":
/*!***************************************!*\
  !*** ./resources/js/pages/c3.init.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: C3 charts init js
*/
!function ($) {
    "use strict";
  
    var ChartC3 = function ChartC3() {};
  
    ChartC3.prototype.init = function () {
      //Line regions
      c3.generate({
        bindto: '#combine-chart',
        data: {
          columns: [['Desktops', 30, 20, 50, 40, 60, 50]],
          types: {
            Desktops: 'bar',
          },
          colors: {
            Desktops: '#dcdcdc',
            Tablets: '#4a81d4',
            Mobiles: '#36404a',
            Watch: '#fb6d9d',
            iPad: '#1abc9c'
          },
          groups: [['Desktops', 'Tablets']]
        },
        axis: {
          x: {
            type: 'categorized'
          }
        }
      }); //roated chart

      c3.generate({
        bindto: '#line-regions',
        data: {
          columns: [['Desktops', 30, 200, 100, 400, 150, 250]],
          regions: {
            'Desktops': [{
              'start': 1,
              'end': 2,
              'style': 'dashed'
            }, {
              'start': 3
            }]
          },
          colors: {
            Desktops: '#4a81d4'
          }
        }
      });
      
      c3.generate({
        bindto: '#refuel-cost',
        data: {
          columns: [['Desktops', 30, 200, 100, 400, 150, 250]],
          regions: {
            'Desktops': [{
              'start': 1,
              'end': 2,
              'style': 'dashed'
            }, {
              'start': 3
            }]
          },
          colors: {
            Desktops: '#4a81d4'
          }
        }
      });
     
    }, $.ChartC3 = new ChartC3(), $.ChartC3.Constructor = ChartC3;
  }(window.jQuery), //initializing 
  function ($) {
    "use strict";
  
    $.ChartC3.init();
  }(window.jQuery);
  
  /***/ }),
  
  /***/ 31:
  /*!*********************************************!*\
    !*** multi ./resources/js/pages/c3.init.js ***!
    \*********************************************/
  /*! no static exports found */
  /***/ (function(module, exports, __webpack_require__) {
  
  module.exports = __webpack_require__(/*! F:\wamp\www\Ubold\laravel\ubold\resources\js\pages\c3.init.js */"./resources/js/pages/c3.init.js");
  
  
  /***/ })
  
  /******/ });