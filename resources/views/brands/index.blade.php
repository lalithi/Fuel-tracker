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
                                            <li class="breadcrumb-item active">Brands</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Brands</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     
        
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Brands</h4>
                                    <p class="sub-header">
                                    Brands of all vehicles
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($brands as $brand)
                                            @php
                                            $more = route('brands.show', [ 'brand' => $brand->id]);
                                            if(app('request')->input('page'))
                                                $more = $more.'?page='.app('request')->input('page');
                                            
                                            $edit = route('brands.edit', ['brand' => $brand->id]);
                                            if(app('request')->input('page'))
                                                $edit = $edit.'?page='.app('request')->input('page');
                                            
                                            $delete = route('brands.destroy', ['brand' => $brand->id]);

                                            @endphp
                                            @if(
                                                (
                                                    (isset($brand_more))&&($brand_more->id == $brand->id)
                                                )||
                                                (
                                                    (isset($brand_edit))&&($brand_edit->id == $brand->id)
                                                )
                                            )
                                            <tr style="background-color:lightsteelblue">
                                            @else
                                            <tr>
                                            @endif
                                                <td>{{ $brand->name }}</td>
                                                <td>{{ $brand->description }}</td>
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
                                        {{ $brands->links() }}
                                        </div>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                            @if(isset($brand_more))
                                <div class="card-box">
                                    <h4 class="header-title">Brand Details</h4>
                                    <p class="sub-header">
                                        Use one of two modifier classes to make <code>&lt;thead&gt;</code>s appear light or dark gray.
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                                <dt class="col-sm-3">Name</dt>
                                                <dd class="col-sm-9">{{ $brand_more->name }}</dd>

                                                <dt class="col-sm-3">Description</dt>
                                                <dd class="col-sm-9">{{ $brand_more->description }}</dd>
                                            </dl>
                                    </div> <!-- end table-responsive-->
        
                                </div> <!-- end card-box -->
                                @elseif(isset($brand_edit))
                                <div class="card-box">
                                    <h4 class="header-title">Update Brand Details</h4>
                                    <p class="sub-header">
                                        Update Brand Details
                                    </p>
                                    @php 
                                    $patch = route('brands.update', ['brand' => $brand->id]);
                                    if(app('request')->input('page'))
                                        $patch = $patch.'?page='.app('request')->input('page');
                                    @endphp
                                    <form action="{{ $patch }}" method="post">
                                    {{csrf_field()}}
                                     {{ method_field('PATCH') }}
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter Name" value="{{ $brand_edit->name }}">
                                                <small id="name" class="form-text text-muted">Name</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" name="description" id="description" aria-describedby="description" placeholder="Enter Description" value="{{ $brand_edit->description }}">
                                                <small id="description" class="form-text text-muted">Description</small>
                                            </div>
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                                @elseif(isset($brand_add))
                                <div class="card-box">
                                    <h4 class="header-title">Add Brand</h4>
                                    <p class="sub-header">
                                        Add Brand Details
                                    </p>
                                    @php 
                                    $add = route('brands.store');
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
                                            
                                            
                                            <a href="" type="button" class="btn btn-primary waves-effect waves-light">Reset</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                        </form>
        
                                </div> <!-- end card-box -->
                            @else    
                            <div class="card-box">
                                    <h4 class="header-title">Brand Details</h4>
                                    <p class="sub-header">
                                        
                                    </p>

                                    <div class="table-responsive" style="overflow-x:hidden">
                                    <dl class="row">
                                    <dt class="col-sm-12"><p>Please click <a href="#" type="button" class="btn btn-success btn-xs waves-effect waves-light">More</a> to view Brand details
                                         </p> </dt>

                                    <dt class="col-sm-12"><p>Please click <a href="{{ url('/brands/create') }}" type="button" class="btn btn-info btn-xs waves-effect waves-light">Add</a> to add a Brand details
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