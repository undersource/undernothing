@extends('base')

@section('content')

INFO
----

Email server is avaible on:

SMTP - 25 port
POP3 - 110 port



LINKS
-----

<a href="{{ Route('emailRegisterForm') }}">Register account</a>

<a href="{{ Route('emailPasswordForm') }}">Change password</a>

<a href="{{ Route('emailUnregisterForm') }}">Unregister account</a>
@endsection