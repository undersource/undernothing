<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class LibraryController extends Controller {
    public function index() {
        $title = 'LIBRARY';
        $authors = Author::all();
        $books = Book::all();

        return view('library/index', compact('title', 'authors', 'books'));
    }
}
