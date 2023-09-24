<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <style>
            body { color: #fff; background: #000; font: calc(0.40em + 1vmin) monospace; text-align: center; } a { color: #aaa; text-decoration: none; } pre>pre { text-align:left; display:inline-block; } img { max-height: 500px; max-width: 500px; }
        </style>
    </head>
    <body>
        <pre>
            @include('elements.header')
        </pre>
        <br>
        <br>
        @forelse ($pictures as $picture)
            <div>
                <img src="{{ asset('storage/pictures/'.$picture->getFilename()) }}">
            </div>
        @empty
            NO PICTURES
        @endforelse
    </body>
</html>