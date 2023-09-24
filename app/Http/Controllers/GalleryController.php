<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;


class GalleryController extends Controller {
    public function gallery() {
        $pictures = File::files(public_path('storage/pictures'));

        return view('gallery', ['title' => 'GALLERY', 'pictures' => $pictures]);
    }
}