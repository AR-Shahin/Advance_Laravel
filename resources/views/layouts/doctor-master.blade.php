@extends('layouts.primary')
@section('main_section')
    <div id="wrapper">
        @include('doctor.includes.sidebar')
        <div id="app">
        <div id="content-wrapper" class="d-flex flex-column" >
            <!-- Main Content -->
            <div id="content">
            @include('doctor.includes.topbar')
            <!-- Begin Page Content -->
                <div class="container-fluid">
                    @if(session('message'))
                        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert" id="alertDiv">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @yield('main_content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" >
                        @csrf
                        <button class="btn btn-primary">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
<script src="{{asset('backend/custom/doctor/custom.js')}}"></script>
@endpush
