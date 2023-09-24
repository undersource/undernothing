@extends('base')

@section('content')


CHANGE PASSWORD
---------------
<form method="post" action="{{ Route('xmppPassword') }}">
@csrf
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<input id="name" name="name" type="text" placeholder="Name"/>

<input id="oldpassword" name="oldpassword" type="password" placeholder="Old Password"/>

<input id="newpassword" name="newpassword" type="password" placeholder="New Password"/>

{!! captcha_img() !!}
<input id="captcha" name="captcha" type="text" placeholder="Captcha"/>

<button type="submit">Submit</button>
</form>
@endsection
