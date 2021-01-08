@extends('layouts.primary')
@section('title','Doctor | Register')

@section('main_section')
    <style>
        body{
            background-color: #34495e;
            background-image: linear-gradient(180deg,#2c3e50 10%,#224abe 100%);
            background-size: cover;
        }
    </style>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register as Doctor!</h1>
                                    </div>
                                    <form class="user" method="post" action="{{route('doctor.register')}}" id="doctorRegisterForm">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Your Name" name="name" value="{{old('name')}}">
                                            <span class="text-danger">{{($errors->has('name'))? ($errors->first('name')) : ''}}</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{old('email')}}">
                                            <span class="text-danger">{{($errors->has('email'))? ($errors->first('email')) : ''}}</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                                            <span class="text-danger">{{($errors->has('password'))? ($errors->first('password')) : ''}}</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="exampleInputPassword" placeholder="Confirm Password" name="password_confirmation">
                                            <span class="text-danger">{{($errors->has('password_confirmation'))? ($errors->first('password_confirmation')) : ''}}</span>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Register</button>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('doctor.login')}}">Already have an account?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@stop

@push('script')
<script>
    $(document).ready(function () {
        //Validate form data
        $('#doctorRegisterForm').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                },
                password: {
                    required: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
</script>
@endpush