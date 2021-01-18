<?php

namespace App\Http\Controllers;

use App\User;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerForm() {
        return view('pages.register');
    }

    public function register(Request $request) {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login');
    }

    public function loginForm() {
        return view('pages.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Проверяем пользователя по email и password
        //Ежели неверный логин или пароль - сообщение
        //Иначе на главную страницу

        if (Auth::attempt([
           'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            return redirect('/');
        }

        return redirect()->back()->with('error', 'Incorrect username or password');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
