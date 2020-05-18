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
                                            <li class="breadcrumb-item active">Models</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Vehicle Models</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     
        
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Models</h4>
                                    <p class="sub-header">
                                    List of Models 
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Model</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($models as $model)
                                            @php
                                            $more = route('models.show', [ 'model' => $model->id]);
                                            if(app('request')->input('page'))
                                                $more = $more.'?page='.app('request')->input('page');
                                            
                                            $edit = route('models.edit', ['model' => $model->id]);
                                            if(app('request')->input('page'))
                                                $edit = $edit.'?page='.app('request')->input('page');
                                            
                                            $delete = route('models.destroy', ['model' => $model->id]);

                                            @endphp
                                            @if(
                                                (
                                                    (isset($model_more))&&($model_more->id == $model->id)
                                                )||
                                                (
                                                    (isset($model_edit))&&($model_edit->id == $model->id)
                                                )
                                            )
                                            <tr style="background-color:lightsteelblue">
                                            @else
                                            <tr>
                                            @endif
                                                <td>{{ $model->name }}</td>
                                                <td>{{ $model->description }}</td>
                                                <td>{{ \App\VehicleBrand::withTrashed()->find($model->vehicle_brand_id)->name }}</td>
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
                                        {{ $models->links() }}
                                        </div>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                            @if(isset($model_more))
                                <div class="card-box">
                                    <h4 class="header-title">Model Details</h4>
                                    <p class="sub-header">
                                        Use one of two modifier classes to make <code>&lt;thead&gt;</code>s appear light or dark gray.
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                                <dt class="col-sm-3">Name</dt>
                                                <dd class="col-sm-9">{{ $model_more->name }}</dd>

                                                <dt class="col-sm-3">Description</dt>
                                                <dd class="col-sm-9">{{ $model_more->description }}</dd>

                                                <dt class="col-sm-3">Brand</dt>
                                                <dd class="col-sm-9">{{ \App\VehicleBrand::withTrashed()->find($model_more->vehicle_brand_id)->name }}</dd>
                                            </dl>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                                @elseif(isset($model_edit))
                                <div class="card-box">
                                    <h4 class="header-title">Update Model Details</h4>
                                    <p class="sub-header">
                                        Update Model Details
                                    </p>
                                    @php 
                                    $patch = route('models.update', ['model' => $model->id]);
                                    if(app('request')->input('page'))
                                        $patch = $patch.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $patch }}" method="post">
                                    {{csrf_field()}}
                                     {{ method_field('PATCH') }}
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter Name" value="{{ $model_edit->name }}">
                                                <small id="name" class="form-text text-muted">Name</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" name="description" id="description" aria-describedby="description" placeholder="Enter Description" value="{{ $model_edit->description }}">
                                                <small id="description" class="form-text text-muted">Description</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="brand">Brand</label>
                                                <select class="form-control" id="brand_id" name="brand_id">
                                                @foreach($brands as $brand)
                                                    @if($brand->id == $model_edit->vehicle_brand_id)
                                                        <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                                    @else
                                                        <option value="{{ $brand->id }}" >{{ $brand->name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                <small id="brand" class="form-text text-muted">Select a Brand</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                                @elseif(isset($model_add))
                                <div class="card-box">
                                    <h4 class="header-title">Add Model</h4>
                                    <p class="sub-header">
                                        Add Model Details
                                    </p>
                                    @php 
                                    $add = route('models.store');
                                    if(app('request')->input('page'))
                                        $add = $add.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $add }}" method="post">
                                    {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter Name">
                                                <small id="name" class="form-text text-muted">Name</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" name="description" id="description" aria-describedby="odometerReading" placeholder="Enter Odometer Reading">
                                                <small id="description" class="form-text text-muted">description</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="brand">Brand</label>
                                                <select class="form-control" id="brand_id" name="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small id="brand" class="form-text text-muted">Select a Brand</small>
                                            </div>
                                            
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                            @else    
                            <div class="card-box">
                                    <h4 class="header-title">Model Details</h4>
                                    <p class="sub-header">
                                        
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a> to view Model details
                                         </p> </dt>

                                    <dt class="col-sm-12"><p>Please click <a href="{{ url('/models/create') }}" type="button" class="btn btn-info btn-xs waves-effect waves-light">Add</a> to add a Model details
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