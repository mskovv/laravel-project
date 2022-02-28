<?php

namespace App\Http\Controllers;

use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        $validate = Validate::check($this->request, [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $remember = $this->request->remember == 'on';

        if(Auth::attempt(['email' => $this->request->email, 'password' => $this->request->password], $remember) ){
            return redirect()->intended('/users');
        }else{
            $session = Session::flash('danger', 'Неверный логин или пароль');
            return back()->withErrors($session)->withInput();;
        }
    }
}
