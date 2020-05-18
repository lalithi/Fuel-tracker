@extends('layouts.master')

@section('content')
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                            <li class="breadcrumb-item active">Fuel Records</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Fuel Records</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     
        
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Fuel Records</h4>
                                    <p class="sub-header">
                                    Fuel Records of all vehicles
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Vehicle</th>
                                                <th>Odometer reading</th>
                                                <th>Cost</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($fuel_records as $fuel_record)
                                            @php
                                            $more = route('fuel-record-details', [ 'fuel-record-id' => $fuel_record->id]);
                                            if(app('request')->input('page'))
                                                $more = $more.'?page='.app('request')->input('page');
                                            
                                            $edit = route('fuel-record-edit', ['fuel-record-id' => $fuel_record->id]);
                                            if(app('request')->input('page'))
                                                $edit = $edit.'?page='.app('request')->input('page');
                                            
                                            $delete = route('fuel-records.destroy', ['fuel_record' => $fuel_record->id]);

                                            @endphp
                                            @if(
                                                (
                                                    (isset($fuel_record_more))&&($fuel_record_more->id == $fuel_record->id)
                                                )||
                                                (
                                                    (isset($fuel_record_edit))&&($fuel_record_edit->id == $fuel_record->id)
                                                )
                                            )
                                            <tr style="background-color:lightsteelblue">
                                            @else
                                            <tr>
                                            @endif
                                                <td>{{ $fuel_record->created_at }}</td>
                                                <td>{{ $fuel_record->vehicle->registration_number }}</td>
                                                <td>{{ $fuel_record->odometer_reading }}</td>
                                                <td>{{ $fuel_record->cost }}</td>
                                                <td style="text-align: right;width:200px">
                                                    <form method="post" action="{{ $delete }}"> 
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ $more }}" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a>
                                                    <a href="{{ $edit }}" type="button" class="btn btn-warning btn-xs waves-effect waves-light">Edit</a>
                                                    
                                                    <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light">Delete</button>
                                               
                                                </form>
                                                     </td>
                                            </tr>
                                            @endforeach
                                           
                                            </tbody>
                                        </table>

                                        <div style="margin-top:25px"></div>
                                        <div style="align:right;width:50[x">
                                        {{ $fuel_records->links() }}
                                        </div>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                            @if(isset($fuel_record_more))
                                <div class="card-box">
                                    <h4 class="header-title">Fuel Record Details</h4>
                                    <p class="sub-header">
                                        Use one of two modifier classes to make <code>&lt;thead&gt;</code>s appear light or dark gray.
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                                <dt class="col-sm-3">Recipt Number</dt>
                                                <dd class="col-sm-9">{{ $fuel_record_more->receipt_number }}</dd>

                                                <dt class="col-sm-3">Odometer reading</dt>
                                                <dd class="col-sm-9">{{ $fuel_record_more->odometer_reading }}</dd>

                                                <dt class="col-sm-3">Cost</dt>
                                                <dd class="col-sm-9">{{ $fuel_record_more->cost }}</dd>
                                            </dl>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                                @elseif(isset($fuel_record_edit))
                                <div class="card-box">
                                    <h4 class="header-title">Update Fuel Record Details</h4>
                                    <p class="sub-header">
                                        Update Fuel Record Details
                                    </p>
                                    @php 
                                    $patch = route('fuel-record-patch', ['fuel-record-id' => $fuel_record_edit->id]);
                                    if(app('request')->input('page'))
                                        $patch = $patch.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $patch }}" method="post">
                                    {{csrf_field()}}
                                     {{ method_field('PATCH') }}
                                            <div class="form-group">
                                                <label for="reciptNumber">Recipt Number</label>
                                                <input type="text" class="form-control" name="receipt_number" id="receipt_number" aria-describedby="reciptNumber" placeholder="Enter Recipt Number" value="{{ $fuel_record_edit->receipt_number }}">
                                                <small id="reciptNumber" class="form-text text-muted">Recipt Number</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="odometerReading">Odometer Reading</label>
                                                <input type="text" class="form-control" name="odometer_reading" id="odometer_reading" aria-describedby="odometerReading" placeholder="Enter Odometer Reading" value="{{ $fuel_record_edit->odometer_reading }}">
                                                <small id="odometerReading" class="form-text text-muted">Odometer Reading</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="cost">Cost</label>
                                                <input type="text" class="form-control" name="cost" id="cost" aria-describedby="cost" placeholder="Enter Cost" value="{{ $fuel_record_edit->cost }}">
                                                <small id="cost" class="form-text text-muted">Cost</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                                @elseif(isset($fuel_record_add))
                                <div class="card-box">
                                    <h4 class="header-title">Add Fuel Record</h4>
                                    <p class="sub-header">
                                        Add Fuel Record Details
                                    </p>
                                    @php 
                                    $add = route('fuel-records.store');
                                    if(app('request')->input('page'))
                                        $add = $add.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $add }}" method="post">
                                    {{csrf_field()}}
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
                                            <div class="form-group">
                                                <label for="personal_vehicle">Vehicle</label>
                                                <select class="form-control" id="personal_vehicle_id" name="personal_vehicle_id">
                                                    @foreach($personal_vehicles as $personal_vehicle)
                                                    <option value="{{ $personal_vehicle->id }}">{{ $personal_vehicle->registration_number }}</option>
                                                    @endforeach
                                                </select>
                                                <small id="personal_vehicle" class="form-text text-muted">Select Vehicle</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                            @else    
                            <div class="card-box">
                                    <h4 class="header-title">Fuel Record Details</h4>
                                    <p class="sub-header">
                                        
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a> to view fuel record details
                                         </p> </dt>

                                    <dt class="col-sm-12"><p>Please click <a href="{{ url('/fuel-records/create') }}" type="button" class="btn btn-info btn-xs waves-effect waves-light">Add</a> to add a fuel record details
                                         </p> </dt>
                                          </dl>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                            @endif
                            
                            </div> <!-- end col -->
        
                        </div>
                        <!-- end row -->
        
        
                    </div> <!-- container -->

@endsection