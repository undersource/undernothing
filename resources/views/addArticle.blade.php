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

        <br>
        <h1>Add article</h1>

        <form method="post" action="{{ Route('articleAdd') }}">
            @csrf

            @error('title')
                {{ $message }}
            @enderror

            @error('text')
                {{ $message }}
            @enderror

            <br>
            <input id="title" name="title" type="text" placeholder="Title" size=55 maxlength=100 required/>
            <br>
            <br>
            <textarea id="text" name="text" placeholder="Text" cols=55 rows=25 maxlength=50000 required></textarea>
            <br>
            <br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>