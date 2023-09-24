@extends('base')

@section('content')


UNREGISTER
----------
<form method="post" action="{{ Route('xmppUnregister') }}">
@csrf
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<input id="name" name="name" type="text" placeholder="Name"/>

<input id="password" name="password" type="password" placeholder="Password"/>

{!! captcha_img() !!}
<input id="captcha" name="captcha" type="text" placeholder="Captcha"/>

<button type="submit">Submit</button>
</form>
@endsection
