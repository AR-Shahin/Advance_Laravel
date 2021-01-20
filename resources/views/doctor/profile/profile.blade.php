@extends('layouts.doctor-master')
@section('title','Doctor | Update-profile')
@push('css')
<style>
    blockquote.custom_block {
        border-left: 5px solid green;
        padding: 10px;
    }
</style>
@endpush
@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary">Update Profile</h3>
                    @php $ex_counter = $doctor->experiences->count(); @endphp
                    <input type="text" id="ex_counter" value="{{$ex_counter}}">
                </div>
                <form action="{{route('doctor.update-profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Name : </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$doctor->name}}">
                                </div>
                                <div class="row no-gutters no-arrow">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Email : </label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{$doctor->email}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Assistant Phone : </label>
                                            <input type="text" class="form-control" id="assistant_phone" name="assistant_phone" value="{{$doctor->assistant_phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="image_preview">
                                    <img src="" alt="" id="dynamic_preview_image" style="max-height: 100px;max-width: 100px;border-radius: 50%">
                                </div>
                                <div class="form-group">
                                    <label for="">Avatar : </label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                    @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2" id="image_hidden">
                                    <img src="{{ asset($doctor->avatar) }}" style="max-height: 50px; border-radius:50%;">
                                </div>
                                <div class="form-group">
                                    <label for="">Country : </label>
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option value="">Select a Country</option>
                                        @forelse($countries as $country)
                                            <option value="{{$country->id}}" {{$doctor->country_id == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                        @empty
                                            <option value="">Empty</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Visit Fee : </label>
                                            <input type="text" class="form-control" id="visit_fee" name="visit_fee" value="{{$doctor->visit_fee}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Break Time : </label>
                                            <input type="text" class="form-control" id="break_time" name="break_time" value="{{$doctor->break_time}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <input type="checkbox" class="d-inline" id="is_offday" value="1" {{$doctor->is_offday==1 ? 'checked' : ''}} name="is_offday"> Is Offday ?
                                    <div class="hidden_off_day mt-2" style="display: none;">
                                        <select name="offday" id="" class="form-control">
                                            <option value="Saturday" {{ $doctor->offday == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                            <option value="Sunday" {{ $doctor->offday == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                            <option value="Monday" {{ $doctor->offday == 'Monday' ? 'selected' : '' }}>Monday</option>
                                            <option value="Tuesday" {{ $doctor->offday == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                            <option value="Wednesday" {{ $doctor->offday == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                            <option value="Thursday" {{ $doctor->offday == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                            <option value="Friday" {{ $doctor->offday == 'Friday' ? 'selected' : '' }}>Friday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Degree : </label>
                                    <!-- Show degree if has -->
                                    {{--{{dd($doctor->education)}}--}}
                                    @php $ed_counter = 0; @endphp
                                    @if($doctor->education)
                                        @foreach($doctor->education as $education)
                                            <table class="table table-bordered" id="dynamic__degree">
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm key_list" placeholder="Degree" id="key" name="education[{{$ed_counter}}][key]" value="{{$education['key']}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm value_list" placeholder="Institution" id="value" name="education[{{$ed_counter}}][value]" value="{{$education['value']}}">
                                                    </td>
                                                    <td>
                                                        <button type="button" id="degree__add" class="btn btn-success" disabled> <i class="fa fa-plus-circle" disabled=""></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                            @php $ed_counter ++; @endphp
                                        @endforeach
                                    @endif
                                    <table class="table table-bordered" id="dynamic_degree">
                                        <input type="hidden" id="counter" value="{{ $ed_counter }}">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control form-control-sm key_list" placeholder="Degree" id="key" name="education[{{$ed_counter}}][key]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm value_list" placeholder="Institution" id="value" name="education[{{$ed_counter}}][value]">
                                            </td>
                                            <td>
                                                <button type="button" id="degree_add" class="btn btn-success"> <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                                <div class="form-group">
                                    <label for="">Bio : </label>
                                    <textarea name="bio" id="bio" cols="30" rows="3" class="form-control">{{$doctor->bio}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $doctor->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Resume: </label>
                                    <input type="file" class="form-control" id="resume" name="resume" value="{{$doctor->resume}}">
                                    @error('resume')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                @if($doctor->resume)
                                    <div class="form-group">
                                        <table class="table table-sm bordered">
                                            <tr>
                                                <th>File</th><th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td>{{$doctor->resume}}</td>
                                                <td class="text-right"><a href="{{asset($doctor->resume)}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fa fa-eye"></i></a></td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="checkbox" name="is_medelist" value="1" {{ $doctor->is_medelist == 1 ? 'checked' : '' }}> Is Medalist?
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <blockquote class="custom_block">
                                    Your Experience!
                                </blockquote>

                                @if($ex_counter > 0)
                                    @foreach($doctor->experiences as $experience)
                                        <div class="clone_doctor__experience mt-4">
                                            <div class="parents_clone_experience">
                                                <h5 class="text-primary mt-3">Experience</h5>
                                                <div class="row">
                                                    <input type="hidden" name="experience_id[]" value="{{ $experience->id }}">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Start Date : </label>
                                                            <input type="date" name="start_date[]" placeholder="Start date" class="form-control" value="{{$experience->start_date}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">End Date : </label>
                                                            <input type="date" name="end_date[]" placeholder="End date" class="form-control" value="{{$experience->end_date}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="">Clinic Name</label>
                                                            <input type="text" class="form-control" name="clinic_name[]" placeholder="Clinic Name" value="{{$experience->clinic_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    <input type="checkbox" name="is_experience" id="experience_checkbox" value="1" > Any Experience?
                                </div>

                                <div class="doctor_experience" style="display: none">
                                    <div class="if_multiple_experience">
                                        <input type="hidden" name="experience_id[]">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Start Date : </label>
                                                    <input type="date" name="start_date[]" placeholder="Start date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">End Date : </label>
                                                    <input type="date" name="end_date[]" placeholder="End date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Clinic Name</label>
                                                    <input type="text" class="form-control" name="clinic_name[]" placeholder="Clinic Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- clone experience start from here -->
                                    <div class="clone_doctor_experience mt-4" style="display: none">
                                        <div class="parents_clone_experience">
                                            <input type="hidden" name="experience_id[]">
                                            <h5 class="text-primary mt-3">Experience</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Start Date : </label>
                                                        <input type="date" name="start_date[]" placeholder="Start date[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">End Date : </label>
                                                        <input type="date" name="end_date[]" placeholder="End date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">Clinic Name</label>
                                                        <input type="text" class="form-control" name="clinic_name[]" placeholder="Clinic Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-danger remove_experience" type="button"><i class="fa fa-minus-circle"></i> Remove</button>
                                        </div>
                                    </div>
                                    <!-- clone experience end here -->
                                    <button style="float: right" id="addMoreExperience" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add More Experience</button>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="">Upload Certificate <small>(You can choose one or multiple)</small></label>
                                    <div class="input-group dynamic_certificate mb-3">
                                        <input type="file" class="form-control" name="certificate[]" value="{{old('certificate')}}">
                                        <button class="btn btn-dark btn-sm add_more_file_btn" type="button"><i class="fa fa-plus-circle"></i> Add More</button>
                                        @error('certificate')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="dynamic_certificate_file mt-2" style="display: none;">
                                        <div class="input-group form-group">
                                            <input type="file" class="form-control" name="certificate[]"value="{{old('certificate')}}" >
                                            <button class="btn btn-danger btn-sm delete_more_file_btn" type="button"><i class="fa fa-minus-circle"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if($doctor->certificates->count() != 0)
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($doctor->certificates as $key => $certificate)
                                                <tr class="control-group">
                                                    <input type="hidden" name="update_certificate[{{ $certificate->id }}]" value="{{ $certificate->id }}">
                                                    <td>{{$key + 1}}</td>
                                                    <td class="text-center">
                                                        <a href="{{asset($certificate->documents)}}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-danger documents-remove"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@push('script')
<script>
    //show if has offday
    if($("#is_offday").prop("checked") == true)
    {
        $('.hidden_off_day').fadeIn();
    }
    //hide show off day
    $('#is_offday').click(function () {
        if($('#is_offday').prop('checked')){
            $('.hidden_off_day').fadeIn(1500);
        }else{
            $('.hidden_off_day').fadeOut(1000);
        }
    });
    //append dynamic degree
    let counter = $('#counter').val();
    $('#degree_add').click(function () {
        var key = $('#key').val();
        var value = $('#value').val();
        key = '';
        value = '';
        counter ++;
        var html = '<tr class="dynamic-added" id="row'+counter+'">';
        html+= '<td><input type="text" class="form-control form-control-sm key_list" placeholder="Degree" id="key" name="education['+counter+'][key]" value="'+key+'"></td>';
        html+= '<td><input type="text" class="form-control form-control-sm value_list" placeholder="Institution" id="value" name="education['+counter+'][value]" value="'+value+'"></td>';
        html += '<td><button type="button" name="remove" id="'+counter+'" class="btn btn-danger fa fa-window-close btn_remove_degree"></button></td></tr>';

        $('#dynamic_degree').append(html);
    });

    //remove dynamic degree row
    $('body').on('click','.btn_remove_degree',function () {
        var id = $(this).attr('id');
        $('#row'+id).remove();
    });

    //hide show experience
    $('#experience_checkbox').click(function () {
        if($('#experience_checkbox').prop('checked')){
            $('.doctor_experience').fadeIn(1500);
        }else{
            $('.doctor_experience').fadeOut(1000);
        }
    })
    //Add more Experience
    $('#addMoreExperience').click(function (e) {
        e.preventDefault();
        var html = $('.clone_doctor_experience').html();
        $('.if_multiple_experience').after(html);
    })
    //remove clone experience
    $('body').on('click','.remove_experience',function () {
        Swal.fire({
            title: 'Do you want to remove this experience?',
            showDenyButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
            $(this).parent(".parents_clone_experience").remove();
        }
    })
    });

    //dynamic certificate add
    $('body').on('click','.add_more_file_btn',function () {
        var html = $('.dynamic_certificate_file').html();
        $('.dynamic_certificate').after(html);
    });
    //remove dynamic certificate
    $('body').on('click','.delete_more_file_btn',function () {
        $(this).parent('.input-group').remove();
    });

    //upload image preview
    $('#image_preview').hide();
    $('body').on('change','#avatar',function () {
        $('#image_preview').fadeIn();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#dynamic_preview_image').attr('src',e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    //documents/ certificate remove
    $("body").on("click",".documents-remove",function(){
        $(this).parents(".control-group").remove();
    });


</script>

@endpush

