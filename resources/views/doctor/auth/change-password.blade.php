@extends('layouts.doctor-master')
@section('title','Doctor | Change-Password')

@section('main_content')

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-primary">Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{route('doctor.change-password')}}" id="doctorChangePasswordForm" method="post">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <label for="">Old Password : </label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="">New Password : </label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password : </label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-block btn-success"><i class="fa fa-edit"></i> Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('script')
<script>

    $(document).ready(function () {
        //Validate form data
        $('#doctorChangePasswordForm').validate({
            rules: {
                oldPassword: {
                    required: true
                },
                newPassword: {
                    required: true,
                    minlength: 3
                },
                confirmPassword: {
                    required: true,
                    equalTo: '#newPassword'
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