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
                                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Home</h4>
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
                                        <h4 class="header-title mb-0">Statistics</h4>

                                        <div id="cardCollpase3" class="collapse pt-3 show">
                                            <div class="text-center">

                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">1,284</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Total Sales</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">7,841</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Open Campaign</p>
                                                    </div>
                                                </div> <!-- end row -->
                                                <div id="morris-bar-example" style="height: 270px;" class="morris-chart mt-3"></div>

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
                                        <h4 class="header-title mb-0">Income Amounts</h4>

                                        <div id="cardCollpase2" class="collapse pt-3 show">
                                            <div class="text-center">
                                                <div class="row mt-2">
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
                                                </div> <!-- end row -->

                                                <div id="morris-area-with-dotted" style="height: 270px;" class="morris-chart mt-3"></div>

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
                                        <h4 class="header-title mb-0">Statistics</h4>

                                        <div id="cardCollpase3" class="collapse pt-3 show">
                                            <div class="text-center">

                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">1,284</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Total Sales</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h3 data-plugin="counterup">7,841</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Open Campaign</p>
                                                    </div>
                                                </div> <!-- end row -->
                                                <div id="morris-bar-example" style="height: 270px;" class="morris-chart mt-3"></div>

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
                                        <h4 class="header-title mb-0">Income Amounts</h4>

                                        <div id="cardCollpase2" class="collapse pt-3 show">
                                            <div class="text-center">
                                                <div class="row mt-2">
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
                                                </div> <!-- end row -->

                                                <div id="morris-area-with-dotted" style="height: 270px;" class="morris-chart mt-3"></div>

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

        <!-- Plugins js -->
        <script src="{{ URL::asset('assets/libs/morris-js/morris-js.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/raphael/raphael.min.js')}}"></script>

        <!-- Dashboard init-->
        <script src="{{ URL::asset('assets/js/pages/dashboard-4.init.js')}}"></script>

@endsection