<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <style>
        span.error{
            font-size: 14px;
            color: red;
            display: inline-block;
            margin-top: 8px;
        }
    </style>
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
@stack('css')
<!-- Custom styles for this template-->
    <link href="{{asset('backend')}}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Page Wrapper -->

@yield('main_section')
@if(session('message')) {{session('message')}} @endif


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Bootstrap core JavaScript-->
<script src="{{asset('backend')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
@stack('script')
<!-- Core plugin JavaScript-->
<script src="{{asset('backend')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('backend')}}/js/sb-admin-2.min.js"></script>

</body>

</html>
