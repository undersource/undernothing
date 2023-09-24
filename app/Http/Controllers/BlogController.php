<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Article;


class BlogController extends Controller {
    public function show() {
        $articles = Article::all();

        return view('blog', ['title' => 'BLOG', 'articles' => $articles]);
    }

    public function addForm(Request $request) {
        if (!Auth::check()) {
            return abort(403);
        }

        return view('addArticle', ['title' => 'ADD ARTICLE']);
    }

    public function add(Request $request) {
        if (!Auth::check()) {
            return abort(403);
        }


        // Validate
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:50000']
        ]);


        // Collect data
        $title = $request->title;
        $text = $request->text;


        // Add new article
        $article = new Article;
        $article->title = $title;
        $article->text = $text;
        $article->save();

        return redirect()->route('blog');
    }

    public function del(Request $request) {
        if (!Auth::check()) {
            return abort(403);
        }

        $referer = $request->headers->get('referer');
        $id = basename($referer);

        $article = Article::where('id', $id)->first();
        $article->delete();

        return redirect()->route('blog');
    }

    public function article(Request $request) {
        $article = Article::where('id', $request->id)->first();

        return view('article', ['title' => 'ARTICLE', 'article' => $article]);
    }
}
