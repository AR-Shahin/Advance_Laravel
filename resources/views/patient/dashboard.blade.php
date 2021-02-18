@extends('layouts.patient-master')
@section('title','Patent | Dashboard')
@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-primary">Appointed Doctors</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Doctor Name</th>
                                <th>Appoint Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @php
                                $appoints = \App\Models\Appointment::with('doctor')->where('patient_id',Auth::guard('patient')->id())->latest()->get() ;
                            @endphp

                            @foreach($appoints as $key => $appoint)
                                <tr>
                                    <th>{{ ++ $key }}</th>
                                    <th>{{$appoint->doctor->name}}</th>
                                    <th>{{$appoint->appointment_time}}</th>
                                    <th>
                                        @if($appoint->status == 0)
                                            <button class="btn btn-primary btn-sm">Pending</button>
                                        @elseif($appoint->status == 1)
                                            <button class="btn btn-success btn-sm py-0">Accepted</button>
                                        @elseif($appoint->status == 2)
                                            <button class="btn btn-warning btn-sm">Seen</button>
                                        @elseif($appoint->status == 3)
                                            <button class="btn btn-danger btn-sm">Reject</button>
                                        @endif
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
