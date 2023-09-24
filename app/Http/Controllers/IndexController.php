<?php

namespace App\Http\Controllers;


class IndexController extends Controller {
    public function index() {
        $random = rand(0, 20);

        return view('index', ['title' => 'INDEX', 'random' => $random]);
    }
}
