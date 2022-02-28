<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use App\UsersInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    function registerUser(){
        $user = UsersInfo::create([
            'user_id' => User::create([
                'email'=> $this->request->email,
                'password' => Hash::make($this->request->password),
            ])->id,
            'username' => $this->request->username,
            'job_title' => $this->request->job_title,
            'phone' => $this->request->phone,
            'address' => $this->request->address,
        ]);
        return redirect()->to('/');
    }

    function log_in(){
        if(Auth::attempt(['email' => $this->request->email, 'password' => $this->request->password]) ){
            return redirect()->intended('/users');
        }else {
            $this->request->session()->flash('danger', 'Неправильный email или пароль :(');
            return redirect()->to('/');
        }
    }

    function updateUserInfo( $id){
        $credentials = $this->request->except('_token');
        $user = UsersInfo::where('id', $id)->update($credentials);
        return redirect()->intended('/users');
    }

    function editSecurityUser(Request $request, $id){
        if($this->request->get('password') === $this->request->get('passwordVerify')) {
            User::where('id', $id)->update([
                'email' => $this->request->email,
                'password' => Hash::make($this->request->password),
            ]);
            return redirect()->intended('/users');
        }else{
//          TODO: flash message -> пароль не совпадает
            return redirect()->back();
        }
    }

    function editUserStatus($id){
        $credentials = $this->request->except('_token');
        $user = UsersInfo::where('id',$id)->update($credentials);
        return redirect()->to('/users');
    }

    function editMedia($id){
        $avatar = UsersInfo::where('id',$id)->first();
        if(isset($avatar->avatar)){
            Storage::delete($avatar->avatar);
        }
        $newImage = $this->request->file('image');
        $avatar->update(['avatar'=> $newImage->store('uploads')]);
        return redirect()->to('/users');
    }

    function deleteUser($id){
        $user = UsersInfo::where('id',$id)->first();
        if(isset($user->avatar)) {
            Storage::delete($user->avatar);
        }
        UsersInfo::where('id',$id)->delete();
        User::where('id', $id)->delete();
        return redirect()->to('/users');
    }


}
