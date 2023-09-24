@extends('base')

@section('content')


LOGIN
---------------
<form method="post" action="{{ Route('auth') }}">
@csrf
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<input id="email" name="email" type="email" placeholder="Email"/>

<input id="password" name="password" type="password" placeholder="Password"/>

{!! captcha_img() !!}
<input id="captcha" name="captcha" type="text" placeholder="Captcha"/>

<button type="submit">Submit</button>
</form>
@endsection