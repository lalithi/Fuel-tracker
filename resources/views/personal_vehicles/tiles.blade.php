@extends('layouts.master')

@section('content')

<style>
.pt-3, .py-3{
    padding-top: 0 !important;
}
</style>
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                            <li class="breadcrumb-item active">My Vehicles</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">My Vehicles</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            @foreach($vehicles as $vehicle)
                            <div class="col-lg-4">
                                <!-- Portlet card -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                            <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h5 class="card-title mb-0">{{ $vehicle->registration_number }}</h5>
                                        <hr>
                                        <div id="cardCollpase1" class="collapse pt-3 show">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                Brand
                                                </div>
                                                <div class="col-lg-4">
                                                {{ $vehicle->brand }}
                                                </div>
                                                <div class="col-lg-2">
                                                Model
                                                </div>
                                                <div class="col-lg-4">
                                                {{ $vehicle->model }}
                                                </div>
                                            </div>
                                            <div style="margin-top:15px"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                Last Refuel Cost
                                                </div>
                                                <div class="col-lg-8">
                                                {{ $vehicle->last_fueled_cost }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                Last Refuel Date
                                                </div>
                                                <div class="col-lg-8">
                                                {{ $vehicle->last_fueled_date }}
                                                </div>
                                            </div>
                                            <div style="margin-top:15px"></div>
                                            <div class="form-group text-right m-b-0">
                                            <div class="button-list">
                                            <a href="{{ $vehicle->more }}" type="button" class="btn btn-info waves-effect waves-light">
                                                    <span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Info
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div><!-- end col -->
                            @endforeach
                    </div> <!-- container -->

@endsection