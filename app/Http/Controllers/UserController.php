<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function get(Request $request) {
        $user_id = $request->get("uid", 0);
        $user = User::find($user_id);
        return $user;
    }
}