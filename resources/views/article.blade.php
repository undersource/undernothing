<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <style>
            body { color: #fff; background: #000; font: calc(0.40em + 1vmin) monospace; text-align: center; } a { color: #aaa; text-decoration: none; } pre>pre { text-align:left; display:inline-block; }
        </style>
    </head>
    <body>
        <pre>
            @include('elements.header')
        </pre>
        @if(Auth::check())[ <a href="{{ Route('articleDel') }}">DEL</a> ]@endif
        <pre>
            <br>
            <pre>
{!! html_entity_decode($article->text) !!}
            </pre>
        </pre>
    </body>
</html>