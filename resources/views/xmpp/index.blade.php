@extends('base')

@section('content')

XMPP server avaible on:

s2s         - 5269 port
c2s         - 5222 port
http upload - 5443 port



LINKS
-----

<a href="{{ Route('xmppRegisterForm') }}">Register account</a>

<a href="{{ Route('xmppPasswordForm') }}">Change password</a>

<a href="{{ Route('xmppUnregisterForm') }}">Unregister account</a>
@endsection