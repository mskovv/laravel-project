<?php

namespace App\Http\Controllers;

use App\User;
use App\UsersInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    function getLoginPage(){
        if (Auth::check()){
            return redirect()->to('/users');
        }
        $warning = $this->request->session()->get('danger');
        return view ('page_login', ['warning' => $warning]);
    }

    function getRegisterPage(){
        if (Auth::check()){
            return redirect()->to('/users');
        }
        return view ('page_register');
    }

    function getUsersPage(){
        if(Auth::check()) {
            $users = UsersInfo::paginate(6);
            return view('users', ['users' => $users]);
        }
        return redirect()->to('/');
    }

    function getCreateUser(){
        return view('create_user');
    }

    function getEditPage($id){
        $user = UsersInfo::where('id', $id)->first();
        return view('edit', ['user' => $user]);
    }

    function getSecurityPage($id){
        $user = User::where('id', $id)->first();
        return view('security', ['user' => $user]);
    }

    function getStatusPage($id){
        $user = UsersInfo::where('id',$id)->first();
        $status = [
            'online' => 'Онлайн',
            'afk' => 'Отошел',
            'busy' => 'Не беспокоить',
        ];
        return view('status', ['user' => $user, 'status' => $status]);
    }

    function getMediaPage($id){
        $user = UsersInfo::where('id',$id)->first();
        return view('media',['user'=>$user]);
    }
}
