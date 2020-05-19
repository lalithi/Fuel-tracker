@extends('layouts.master')

@section('content')

        <!-- C3 Chart css -->
        <link href="http://verticle.local/assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css" />
        
        <link href="http://verticle.local/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                   
                                    
                                    <div class="row">
                                    <div class="col-1">
                                    <h4 class="page-title">Home</h4>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-1" style="margin-top: 22px;">
                                                       Select Vehicle
                                                    </div>
                                                    <div class="col-4" style="margin-top: 14px;">
                                                    <select class="form-control" id="personal_vehicle_id" name="personal_vehicle_id" onchange="update_vehicle()">
                                                    @foreach($personal_vehicles as $personal_vehicle)
                                                    <option value="{{ $personal_vehicle->id }}">{{ $personal_vehicle->registration_number }}</option>
                                                    @endforeach
                                                </select>
                                                    </div>
                                                    <div class="col-6">
                                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                        </ol>
                                    </div>
                                                    </div>
                                                </div> <!-- end row -->
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        

                        <div class="row">

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" dir="ltr">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Add a Fuel record</h4>

                                        <div id="cardCollpase3" class="collapse pt-3 show">


                                        <div id="accordion" class="mb-3">
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">
                                                <a class="text-dark collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    Upload a recipt
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                            <div class="card-body">
                                            <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a file here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" class="dropify" data-max-file-size="5M" id="image"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">
                                                <a class="text-dark collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    Manually Add a Fuel Record
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="">
                                            <div class="card-body">
                                            <div class="">
                                            @php 
                                    $add = route('fuel-records.store');
                                    if(app('request')->input('page'))
                                        $add = $add.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $add }}" method="post">
                                    {{csrf_field()}}

                                 
                                            <input type="hidden"  name="personal_vehicle_id" id="personal_vehicle_id" value="{{ $selected->id }}">
                                                
                                            <div class="form-group">
                                                <label for="reciptNumber">Recipt Number</label>
                                                <input type="text" class="form-control" name="receipt_number" id="receipt_number" aria-describedby="reciptNumber" placeholder="Enter Recipt Number">
                                                <small id="reciptNumber" class="form-text text-muted">Recipt Number</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="odometerReading">Odometer Reading</label>
                                                <input type="text" class="form-control" name="odometer_reading" id="odometer_reading" aria-describedby="odometerReading" placeholder="Enter Odometer Reading">
                                                <small id="odometerReading" class="form-text text-muted">Odometer Reading</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="refuel_amount">Refuel Amount</label>
                                                <input type="text" class="form-control" name="refuel_amount" id="refuel_amount" aria-describedby="refuel_amount" placeholder="Enter Refuel Amount">
                                                <small id="refuel_amount" class="form-text text-muted">Cost</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="cost">Cost</label>
                                                <input type="text" class="form-control" name="cost" id="cost" aria-describedby="cost" placeholder="Enter Cost">
                                                <small id="cost" class="form-text text-muted">Cost</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="fuel_type">Fuel Type</label>
                                                <select class="form-control" id="fuel_type_id" name="fuel_type_id">
                                                @foreach($fuel_types as $fuel_type)
                                                    <option value="{{ $fuel_type->id }}">{{ $fuel_type->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small id="fuel_type" class="form-text text-muted">Select Fuel Type</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                        </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>


                                    
                                        </div> <!-- end collapse-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" dir="ltr">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Fuel Economy</h4>

                                        <div id="cardCollpase2" class="collapse pt-3 show">
                                    
                                            <div class="text-center">
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">{{ number_format((float)$a, 2, '.', '') }}</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">km/l</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">{{ number_format((float)$e, 2, '.', '') }}</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">km / $</p>
                                                    </div>
                                                </div> 

                                                <div id="line-regions" style="height: 300px;" dir="ltr"></div>

                                            </div>
                                        </div> <!-- end collapse-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" dir="ltr">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Refuel Amount ( Last 10 Transactions )</h4>

                                        <div id="cardCollpase3" class="collapse pt-3 show">
                                            <div class="text-center">

                                                <!-- <div class="row mt-2">
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">1,284</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Total Sales</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">7,841</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Open Campaign</p>
                                                    </div>
                                                </div> end row -->
                                                <div id="combine-chart" style="height: 300px;" dir="ltr"></div>

                                            </div>
                                        </div> <!-- end collapse-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body" dir="ltr">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Refuel Cost ( Last 10 Transactions )</h4>

                                        <div id="cardCollpase2" class="collapse pt-3 show">
                                            <div class="text-center">
                                                <!-- <div class="row mt-2">
                                                    <div class="col-4">
                                                        <h3 data-plugin="counterup">2,845</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Total Sales</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h3 data-plugin="counterup">6,487</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Open Campaign</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h3 data-plugin="counterup">201</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Daily Sales</p>
                                                    </div>
                                                </div> end row -->

                                                <div id="refuel-cost" style="height: 300px;" dir="ltr"></div>

                                            </div>
                                        </div> <!-- end collapse-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        
                    </div> <!-- container -->

@endsection

@section('script')
        
        <!--C3 Chart-->
        <script src="http://verticle.local/assets/libs/d3/d3.min.js"></script>
        <script src="http://verticle.local/assets/libs/c3/c3.min.js"></script>

        <script src="http://verticle.local/assets/libs/dropify/dropify.min.js"></script>
        <!-- Dashboard init-->
        <script>


var fileNode = document.querySelector('#image'),
        form = new FormData(),
        xhr = new XMLHttpRequest();

    fileNode.addEventListener('change', function( event ) {
        event.preventDefault();

        var files = this.files;
        for (var i = 0, numFiles = files.length; i < numFiles; i++) {
            var file = files[i];

            // check mime
            if (['image/png', 'image/jpg'].indexOf(file.type) == -1) {
                // mime type error handling
            }

            form.append('files[]', file, file.name);
            form.append('_token', '{{ csrf_field() }}');
            form.append('vehicle_id', '{{ $selected->id }}');
            

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // do sth with the response
                }
            }

            xhr.open('POST', '{{ url("/home") }}');
            xhr.send(form);
        }
    });


        function update_vehicle(){
            var personal_vehicle_id = 0;
            personal_vehicle_id = document.getElementById('personal_vehicle_id').value;

            window.location.replace("{{ url('/') }}"+'/home?v='+personal_vehicle_id);
        }
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
          columns: [['Cost', 
          @foreach($cost as $c)
          {{ $c.','}}
          @endforeach
          ]],
          types: {
            Cost: 'bar',
          },
          colors: {
            Desktops: '#dcdcdc'
          },
          groups: [['Cost']]
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
          columns: [['Efficiency',
          @foreach($efficiency as $w)
          {{ $w.','}}
          @endforeach]],
          colors: {
            Efficiency: '#4a81d4'
          }
        }
      });
      
      c3.generate({
        bindto: '#refuel-cost',
        data: {
          columns: [['Amount', 
          @foreach($amount as $q)
          {{ $q.','}}
          @endforeach
          ]],
          types: {
            Amount: 'bar',
          },
          colors: {
            Amount: '#4a81d4'
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
        </script>

@endsection