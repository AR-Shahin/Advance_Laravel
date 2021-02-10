<html>
<body>
<p>I am from event listener</p>
Hi,{{$patient->name}} <br>
Please verify this account, <a href="{{route('patient.verify',$patient->token)}}">Click Here</a>
</body>
</html>