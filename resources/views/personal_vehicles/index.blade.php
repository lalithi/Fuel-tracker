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
                                            <li class="breadcrumb-item active">Vehicles</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">My Vehicle</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     
        
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">My Vehicles</h4>
                                    <p class="sub-header">
                                    List of Personal Vehicles. Please click <a href="{{ url('vehicles/create') }}">here</a> to add a new Vehicle</p>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Registration Number</th>
                                                <th>Model</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vehicles as $vehicle)
                                            @php
                                            $more = route('vehicles.show', [ 'vehicle' => $vehicle->id]);
                                            if(app('request')->input('page'))
                                                $more = $more.'?page='.app('request')->input('page');
                                            
                                            $edit = route('vehicles.edit', ['vehicle' => $vehicle->id]);
                                            if(app('request')->input('page'))
                                                $edit = $edit.'?page='.app('request')->input('page');
                                            
                                            $delete = route('vehicles.destroy', ['vehicle' => $vehicle->id]);
                                            $m = \App\VehicleModel::withTrashed()->find($vehicle->vehicle_model_id);
                                            $b = \App\VehicleBrand::withTrashed()->find($m->vehicle_brand_id);
                                            @endphp
                                            @if(
                                                (
                                                    (isset($vehicle_more))&&($vehicle_more->id == $vehicle->id)
                                                )||
                                                (
                                                    (isset($vehicle_edit))&&($vehicle_edit->id == $vehicle->id)
                                                )
                                            )
                                            <tr style="background-color:lightsteelblue">
                                            @else
                                            <tr>
                                            @endif
                                                <td>{{ $vehicle->registration_number }}</td>
                                                <td>{{ $m->name." - ".$b->name }}</td>
                                                <td style="text-align: right;width:200px">
                                                    <form method="post" action="{{ $delete }}"> 
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ $more }}" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a>
                                                    <a href="{{ $edit }}" type="button" class="btn btn-warning btn-xs waves-effect waves-light">Edit</a>
                                                    
                                                    <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm('Are you sure you want to delete this Vehicle?');">Delete</button>
                                               
                                                </form>
                                                     </td>
                                            </tr>
                                            @endforeach
                                           
                                            </tbody>
                                        </table>

                                        <div style="margin-top:25px"></div>
                                        <div style="align:right;width:50[x">
                                        {{ $vehicles->links() }}
                                        </div>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                            @if(isset($vehicle_more))
                                <div class="card-box">
                                    <h4 class="header-title">Vehicle Details</h4>
                                    <p class="sub-header">
                                    Vehicle Details of <strong>{{ $vehicle_more->registration_number }}</strong>
                                    </p>
                                    @include('flash-message')
                                    @php  
$m = App\VehicleModel::withTrashed()->find($vehicle_more->vehicle_model_id);
$b = \App\VehicleModel::withTrashed()->find($m->vehicle_brand_id);
@endphp
                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                    <dt class="col-sm-3">Brand</dt>
                                    <dd class="col-sm-9">{{ $b->name }}</dd>
                                
                                    <dt class="col-sm-3">Model</dt>
                                    <dd class="col-sm-9">{{ $m->name }}</dd>
                                
                                    <dt class="col-sm-3">Registration Number</dt>
                                    <dd class="col-sm-9">{{ $vehicle_more->registration_number }}</dd>

                                    </dl>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                                @elseif(isset($vehicle_edit))
                                <div class="card-box">
                                    <h4 class="header-title">Update Vehicle Details</h4>
                                    <p class="sub-header">
                                        Update Vehicle Details of {{ $vehicle_edit->registration_number }}
                                    </p>
                                    @include('flash-message')
                                    @if($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>

                                            @foreach($errors->all() as $error)
                                                {{ $error }}<br/>
                                            @endforeach
                                        </div>
                                    @endif
                                    @php 
                                    $patch = route('vehicles.update', ['vehicle' => $vehicle_edit->id]);
                                    if(app('request')->input('page'))
                                        $patch = $patch.'?page='.app('request')->input('page');


                                        $edit = route('vehicles.edit', ['vehicle' => $vehicle_edit->id]);
                                            if(app('request')->input('page'))
                                                $edit = $edit.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $patch }}" method="post">
                                    {{csrf_field()}}
                                     {{ method_field('PATCH') }}
                                            <div class="form-group">
                                                <label for="brand">Model</label>
                                                <select class="form-control" id="model_id" name="model_id">
                                                @foreach($models as $model)
                                                    @if($model->id == $vehicle_edit->vehicle_model_id)
                                                        <option value="{{ $model->id }}" selected>{{ $model->name }}</option>
                                                    @else
                                                        <option value="{{ $model->id }}" >{{ $model->name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                <small id="brand" class="form-text text-muted">Select a Model</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="registration_number">Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number" id="registration_number" aria-describedby="registration_number" placeholder="Enter Registration Number" value="{{ $vehicle_edit->registration_number }}">
                                                <small id="registration_number" class="form-text text-muted">Registration Number</small>
                                            </div>
                                            
                                            <a href="{{  $edit }}" type="button" class="btn btn-light waves-effect">Reset</a>
                                            <button type="submit" class="btn btn-blue waves-effect waves-light">Update</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                                @elseif(isset($vehicle_add))
                                <div class="card-box">
                                    <h4 class="header-title">Add Vehicle</h4>
                                    <p class="sub-header">
                                        Add Vehicle Details
                                    </p>
                                    @include('flash-message')
                                    @if($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>

                                            @foreach($errors->all() as $error)
                                                {{ $error }}<br/>
                                            @endforeach
                                        </div>
                                    @endif
                                    @php 
                                    $add = route('vehicles.store');
                                    if(app('request')->input('page'))
                                        $add = $add.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $add }}" method="post">
                                    {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="brand">Vehicle Model</label>
                                                <select class="form-control" id="model_id" name="model_id">
                                                @foreach($models as $model)
                                                        <option value="{{ $model->id }}" selected>{{ $model->name }}</option>
                                               
                                                @endforeach
                                                </select>
                                                <small id="brand" class="form-text text-muted">Select a Model</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="registration_number">Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number" id="registration_number" aria-describedby="registration_number" placeholder="Enter Registration Number">
                                                <small id="registration_number" class="form-text text-muted">Registration Number</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                            @else    
                            <div class="card-box">
                                    <h4 class="header-title">Vehicle Details</h4>
                                    <p class="sub-header">
                                        
                                    </p>
                                    @include('flash-message')
                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                    <dt class="col-sm-12"><p>Please click <a href="{{ url('/vehicles/create') }}" type="button" class="btn btn-info btn-xs waves-effect waves-light">Add</a> to Add a New Vehicle
                                         </p> </dt>
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a> to View Vehicle Details
                                         </p> </dt>
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-warning btn-xs waves-effect waves-light">Edit</a> to View Edit a Specific Vehicle
                                         </p> </dt>
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-danger btn-xs waves-effect waves-light">Delete</a> to Delete a Specific Vehicle
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