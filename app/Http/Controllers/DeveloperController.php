<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        return 'В разработке';
        //return view('developer.index');
    }
}
