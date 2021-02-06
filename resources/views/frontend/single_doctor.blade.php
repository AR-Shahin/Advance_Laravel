@extends('layouts.app')
@section('title') {{$doctor->name}}'s Profile @stop
@push('css')
<style>
    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
</style>
@endpush
@section('content')
    <!-- NabVar -->
    <div class="wrapping" style="overflow:hidden;">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Doctor
                </a>
            </div>
        </nav>

        <!-- Doctor's Content -->
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset($doctor->avatar)}}" alt="{{$doctor->name}}" class="img-fluid w-75 m-auto">
                </div>
                <div class="col-md-9">
                    <div class="header">
                        <div class="row">
                            <div class="col-8">
                                <h1 class="mb-0">{{$doctor->name}}</h1>
                                <h6><em> {{ $doctor->designation->name ?? 'No designation' }}</em></h6>
                                <p class="mb-0">Feedback : <span>{{ $doctor->feedbacks()->count() }}</span></p>
                            </div>
                            <div class="col-4">
                                <a href="" class="btn btn-sm btn-success"><i class="fa fa-plus mr-1"></i> Appoint Me</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="middle">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#About" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Bio" role="tab" aria-controls="profile" aria-selected="false">Bio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Education" role="tab" aria-controls="contact" aria-selected="false">Education</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Experience" role="tab" aria-controls="contact" aria-selected="false">Experience</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Feedback" role="tab" aria-controls="contact" aria-selected="false">Feedback</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="About" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Country</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->country->name ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Assistant Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->assistant_phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->experience }} Years</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Visit Fee</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->visit_fee }} Taka</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Offday</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->offday }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Break Time</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->break_time }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Medalist</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $doctor->is_medelist == 1 ? 'Medelist' : 'Not A Medelist'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Bio" role="tabpanel" aria-labelledby="profile-tab">{{$doctor->bio}}</div>
                            <div class="tab-pane fade" id="Education" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="50%">Deegre</th>
                                        <th width="50%">Institution</th>
                                    </tr>
                                    @if(!empty($doctor->education))
                                        @forelse ($doctor->education as $education)
                                            <tr>
                                                <td width="50%">{{ $education['key'] }}</td>
                                                <td width="50%">{{ $education['value'] }}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    @endif

                                </table>
                            </div>
                            <div class="tab-pane fade" id="Experience" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL</th>
                                        <th>Clinic Name</th>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                    </tr>
                                    @forelse ($doctor->experiences as $key=> $experience)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$experience->clinic_name ?? ''}}</td>
                                            <td>{{$experience->start_date ?? ''}}</td>
                                            <td>{{$experience->end_date ?? ''}}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </table>
                            </div>
                            <div class="tab-pane fade" id="Feedback" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
