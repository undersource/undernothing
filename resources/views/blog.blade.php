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
        <pre>
        @if(Auth::check())[ <a href="{{ Route('articleAddForm') }}">ADD</a> ]@endif
        </pre>
        <pre>


@forelse ($articles as $article)
- <a href="{{ Route('article', ['id' => $article->id]) }}">{{ $article->title }}</a>

@empty
NO ARTICLES
@endforelse
        </pre>
    </body>
</html>