<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//TOD: 1)uploads avatars
//TOD: 3)delete user
//24.02 1.5 hours
//TOD: 6)make edit media

//TOD: 7)implement middleware
//25.02 1 hour


//TODO: 2)flashing messages
//TODO: 5)implement profile page

//TODO: 4)make after register going to page edit user information

use App\UsersInfo;
use Illuminate\Support\Facades\Auth;

//Route::get('/',"ViewController@getLoginPage");
//Route::get('/register', "ViewController@getRegisterPage");
//Route::get('/users', "ViewController@getUsersPage");
//Route::get('/create_user', "ViewController@getCreateUser");
//Route::get('/edit/{id}', "ViewController@getEditPage");
//Route::get('/security/{id}', "ViewController@getSecurityPage");
//Route::get('/status/{id}', "ViewController@getStatusPage");
//Route::get('/media/{id}', "ViewController@getMediaPage");
//
//Route::post('/registerUser', 'UsersController@registerUser');
//Route::post('/update/{id}', 'UsersController@updateUserInfo');
//Route::post('/security/{id}', 'UsersController@editSecurityUser');
//Route::post('/status/{id}', 'UsersController@editUserStatus');
//Route::post('/media/{id}', 'UsersController@editMedia');
//Route::get('/delete/{id}', 'UsersController@deleteUser');
//Route::post('/login', 'AuthController@login');

Route::middleware('auth')->group(function (){
    Route::get('/users', "ViewController@getUsersPage");
    Route::get('/create_user', "ViewController@getCreateUser");
    Route::get('/edit/{id}', "ViewController@getEditPage");
    Route::get('/security/{id}', "ViewController@getSecurityPage");
    Route::get('/status/{id}', "ViewController@getStatusPage");
    Route::get('/media/{id}', "ViewController@getMediaPage");
    Route::post('/registerUser', 'UsersController@registerUser');
    Route::post('/update/{id}', 'UsersController@updateUserInfo');
    Route::post('/security/{id}', 'UsersController@editSecurityUser');
    Route::post('/status/{id}', 'UsersController@editUserStatus');
    Route::post('/media/{id}', 'UsersController@editMedia');
    Route::get('/delete/{id}', 'UsersController@deleteUser');
});

Route::middleware('guest')->group(function (){
    Route::get('/', ['as'=>'login', 'uses' => "ViewController@getLoginPage"]);
    Route::get('/register', "ViewController@getRegisterPage");
    Route::post('/login', 'AuthController@login');
});


//Наполнение таблицы Users и Users_info рыбными данными
//Route::get('/users', function (){
//    factory(UsersInfo::class, 5)->create();
//});


//Route::get('/users', "ViewController@getUsersPage");

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function (){
    Auth::logout();
    return redirect()->to('/');
});
