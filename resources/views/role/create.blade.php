@extends('layouts.app')
@section('title')
    Create Roles and Permissions
@endsection
@section('content')

<div class="container mt-4">
    <h2 class="text-center">Create Roles and Permissions</h2>
    <a href="{{ route('role.index') }}" class="btn btn-info btn-sm">Back</a>
    <hr>
    <form action="{{ route('role.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Role Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <h6>Permissions</h6>
        <hr>

            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="permission_all" value="1">
                <label for="permission_all" class="custom-control-label">All</label>
            </div>
            <hr>
            @php $i=1; @endphp
            @foreach ($permission_groups as $group)
                <div class="row">
                    <div class="col-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="{{ $i }}management" onclick="CheckPermissionByGroup('role-{{ $i }}-management-checkbox',this)" value="2">
                            <label for="{{ $i }}management" class="custom-control-label text-capitalize">{{ $group->name }}</label>
                        </div>
                    </div>
                    <div class="col-9 role-{{ $i }}-management-checkbox">
                        @php
                            $permissionss = App\Models\User::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp
                        @foreach ($permissionss as $permission)
                        <div class="custom-control custom-checkbox">
                            <input name="permissions[]" class="custom-control-input" type="checkbox" id="permission_checkbox_{{ $permission->id }}" value="{{ $permission->name }}" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" >
                            <label for="permission_checkbox_{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                        </div>
                        @php $j++; @endphp
                        @endforeach
                    </div>
                </div>
                <hr>
                @php $i++; @endphp
            @endforeach
            <div class="form-group">
                <button class="btn btn-block btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
@stop
@push('script')
    <script>
        $('#permission_all').click(function(){
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked',true);
            }else{
                // uncheck all the checkbox
                $('input[type=checkbox]').prop('checked',false);
            }
        });

        // check permission by group
        function CheckPermissionByGroup(classname,checkthis){
           // console.log(checkthis);
            const groupIdName = $("#"+checkthis.id);
           // console.log(groupIdName);
            const classCheckBox = $('.'+classname+' input');
            if (groupIdName.is(':checked')) {
                // check all the checkbox
                classCheckBox.prop('checked',true);
            }else{
                // uncheck all the checkbox
                classCheckBox.prop('checked',false);
            }
            implementAllChecked()
        }
        function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            console.log($('.'+groupClassName+ ' input:checked'));
                const classCheckbox = $('.'+groupClassName+ ' input');
                const groupIDCheckBox = $("#"+groupID);
                // if there is any occurance where something is not selected then make selected = false
                if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                    groupIDCheckBox.prop('checked', true);
                }else{
                    groupIDCheckBox.prop('checked', false);
                }
                implementAllChecked();
            }
           function implementAllChecked() {
             const countPermissions = {{ count($permissions) }};
             const countPermissionGroups = {{ count($permission_groups) }};
            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);
             if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }
    </script>
@endpush

