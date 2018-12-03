<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Subscription;
use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function subscribe(Request $request) {
        $this->validate($request, [
           'email' => 'required|unique:subscriptions'
        ]);

        $subs = Subscription::add($request->get('email'));

        Mail::to($subs)->send(new SubscribeEmail($subs));//Из документаци laravel отправка в почту

        return redirect()->back()->with('status', 'Проверьте вашу почту');
    }
}
