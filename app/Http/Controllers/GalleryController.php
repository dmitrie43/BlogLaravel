<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        $gallery = Gallery::all();
        $image = Gallery::where('id', '>', 0)->first();

        return view('pages.gallery', [
            'gallery' => $gallery,
            'image' => $image
        ]);
    }
}
