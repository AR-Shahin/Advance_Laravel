<html>
<body>
Hi,{{$doctor->name}} <br>
Please verify this account, <a href="{{route('doctor.verify',$doctor->verified_token)}}">Click Here</a>
<a href="{{url('doctor.verify/',$doctor->verified_token)}}">click</a>
</body>
</html>