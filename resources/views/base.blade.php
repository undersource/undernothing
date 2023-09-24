<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <style>
            body { color: #fff; background: #000; font: calc(0.40em + 1vmin) monospace; text-align: center; } a { color: #aaa; text-decoration: none; } pre>pre { text-align: left; display: inline-block; }
        </style>
    </head>
    <body>
        <pre class="header">
        @include('elements.header')
        </pre>
        <pre>
            <pre>
        @yield('content')
            </pre>
        </pre>
    </body>
</html>
