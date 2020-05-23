@extends('layouts.master-without-nav')
@section('body')
    <body class="authentication-bg authentication-bg-pattern">
@endsection
@section('content')
<div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                        @csrf

                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email">

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" placeholder="Enter your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                           
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                            <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"> Sign Up </button>
                                    </div>
                                    <div class="form-group mb-0">
                                    <!-- by signing up you agree to <a href="{{ url('/terms-and-conditions') }}">Our Terms & Conditions</a> -->
                                    </div>

                                </form>
<!-- 
                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                    </ul>
                                </div> -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="{{ url('/login') }}" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                            <div class="footer-links d-none d-sm-block">
                    <!-- <a href="{{ url('about-us') }}"  style="color:white">About Us<span style="color:white;padding-left:15px">|</span></a>
                    <a href="{{ url('help') }}" style="color:white;padding-left:15px">Help & FAQs<span style="color:white;padding-left:15px">|</span></a>
                    <a href="{{ url('contact-us') }}" style="color:white;padding-left:15px">Contact Us</a> -->
                </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
        {{date('Y')}} &copy; <a href="{{ url('/') }}" style="color:white">MyFuelTracker.com</a> 
        </footer>
@endsection
