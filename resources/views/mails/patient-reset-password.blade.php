<html>
<body>
Hi,{{$patient->name}} <br>
Please reset your password, <a href="{{route('patient.reset--password',$patient->reset_pass_token)}}">Click Here</a>
</body>
</html>