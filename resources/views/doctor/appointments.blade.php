@extends('layouts.doctor-master')
@section('title','Doctor | Appointment')
@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary">Appointed Patients</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @forelse($patients as $key => $patient)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$patient->patient->name}}</td>
                        <td>{{$patient->appointment_time}}</td>
                        <td>
                            @if($patient->status == 0)
                                <span class="badge badge-warning">Pending</span>
                            @elseif($patient->status == 1)
                                <span class="badge badge-info">Approved</span>
                            @elseif($patient->status == 2)
                                <span class="badge badge-success">Seen</span>
                            @elseif($patient->status == 3)
                                <span class="badge badge-danger">Canceled</span>
                            @endif
                        </td>
                        <td>
                            @if($patient->status == 0)
                                <a class="btn btn-sm btn-warning" href="{{route('doctor.approve.appointment',['id' => $patient->id, 'patient' => $patient->patient->id])}}">Approve</a>
                                <a class="btn btn-sm btn-danger" href="">Cancel</a>
                            @elseif($patient->status == 1)
                                <a class="btn btn-sm btn-success" href="{{route('doctor.seen.appointment',['id' => $patient->id, 'patient' => $patient->patient->id])}}">Seen</a>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </table>
        </div>
    </div>
@stop
