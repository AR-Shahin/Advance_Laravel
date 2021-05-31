@extends('layouts.app')
@section('title','Doctor Application')
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
            <form action="{{route('home')}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect04" name="country">
                                <option value="0">Select Your Country.....</option>
                                @forelse(\App\Models\Country::select('id','name')->latest()->get() as $country)
                                    <option @if($country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            <select class="custom-select" id="inputGroupSelect04" name="designations">
                                <option value="0">Search a Designations.....</option>
                                @forelse(\App\Models\Designations::select('id','name')->latest()->get() as $designation)
                                    <option @if($designations_id == $designation->id) selected @endif  value="{{$designation->id}}">{{$designation->name}}</option>
                                @empty
                                @endforelse
                            </select>

                                <input type="text" class="form-control" name="visit" placeholder="Enter Visit Fees" value="{{ $visit }}">

                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Designation : </b> {{$doctor->designation->name ?? 'Null'}}</li>
                                    <li class="list-group-item"><b>Country : </b> {{$doctor->country->name ?? 'Null'}}</li>
                                    <li class="list-group-item">
                                        <span><b>Ratting [{{$doctor->feedbacks()->count()}}] : </b></span>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{route('doctor.details',$doctor->slug)}}" class="card-link btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> View</a>
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
