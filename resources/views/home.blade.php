@extends('layouts.app')
@section('title','Find a Doctor.')
@section('content')
    <!-- NabVar -->
    <div class="wrapping" style="overflow:hidden;">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Doctor
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <div id="hero_Section" class="mt-5 pt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04">
                            <option selected>Search a Doctor.....</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div id="doctor_section" class="mt-4">
            <div class="container-fluid">
                <div class="row" id="viewAllDoctor">
                    @forelse($doctors as $doctor)
                    <div class="col-12 col-sm-6 col-md-3" style="box-shadow: 1px 2px 5px #ccc">
                        <div class="card border-secondary ">
                            <img class="card-img-top w-100" src="{{asset($doctor->avatar)}}" alt="{{$doctor->name}}" height="270px">
                            <div class="card-body">
                                <h5 class="card-title">{{$doctor->name}}</h5>
                                <p class="card-text">{{$doctor->bio}}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Designation : </b> {{$doctor->designation->name ?? 'Null'}}</li>
                                <li class="list-group-item"><b>Country : </b> {{$doctor->country->name ?? 'Null'}}</li>
                                <li class="list-group-item">
                                    <span><b>Ratting ({{$doctor->feedbacks()->count()}}) : </b></span>
                                    <i class="fa fa-star mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                </li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> View</a>
                                <a href="#" class="card-link btn btn-sm btn-outline-success" style="float: right"><i class="fa fa-plus"></i> Appoint</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div> <!-- Wrapping -->
@stop