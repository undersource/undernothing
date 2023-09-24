@extends('base')

@section('content')
<pre>
       .--.                   .---.
   .---|__|           .-.     |~~~|
.--|===|--|_          |_|     |~~~|--.
|  |===|  |'\     .---!~|  .--|   |--|
|%%|   |  |.'\    |===| |--|%%|   |  |
|%%|   |  |\.'\   |   | |__|  |   |  |
|  |   |  | \  \  |===| |==|  |   |  |
|  |   |__|  \.'\ |   |_|__|  |~~~|__|
|  |===|--|   \.'\|===|~|--|%%|~~~|--|
^--^---'--^    `-'`---^-^--^--^---'--'
</pre>


BOOKS
-----
@forelse ($authors as $author)

{{ $author->name }}
<ol>
@foreach (App\Models\Book::where('author_id', $author->id)->get() as $book)
<li>{{ $book->name }}@foreach (App\Models\BookFile::where('book_id', $book->id)->get() as $file) (<a href="{{ asset('storage/books/'.$author->path.'/'.$file->name) }}">@if(preg_match('/\.([^.]+)$/', $file->name, $matches)){{ $matches[1] }}@else{{ "file" }}@endif
</a>)@endforeach
</li>
@endforeach
</ol>
@empty

Empty library
@endforelse
@endsection
