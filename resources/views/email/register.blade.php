@extends('base')

@section('content')


REGISTER
--------
<form method="post" action="{{ Route('emailRegister') }}">
@csrf
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<input id="name" name="name" type="text" placeholder="Name"/>

<input id="password" name="password" type="password" placeholder="Password"/>

<input id="password" name="password_confirmation" type="password" placeholder="Password again"/>

{!! captcha_img() !!}
<input id="captcha" name="captcha" type="text" placeholder="Captcha"/>

<button type="submit">Submit</button>
</form>
@endsection
