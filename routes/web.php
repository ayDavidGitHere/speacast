<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app', ['pageKey' => 'home', 'PAGE_TITLE' => 'LaraPod - Play,Upload,Get Podcasts']);
});


$CONTROLLER_NAMESPACE = "App\Http\Controllers";

// User authentication routes
Route::get('/login', "$CONTROLLER_NAMESPACE\AuthController@showLoginForm")->name('login');
Route::post('/login', "$CONTROLLER_NAMESPACE\AuthController@login")->name('login');
Route::post('/logout', "$CONTROLLER_NAMESPACE\AuthController@logout")->name('logout');
Route::get('/register', "$CONTROLLER_NAMESPACE\AuthController@showRegistrationForm")->name('register');
Route::post('/register', "$CONTROLLER_NAMESPACE\AuthController@register")->name('register');

// User profile routes
/*
Route::get('/profile', "$CONTROLLER_NAMESPACE\ProfileController@show")->name('profile');
Route::get('/profile/edit', "$CONTROLLER_NAMESPACE\ProfileController@edit")->name('profile.edit');
Route::post('/profile/update', "$CONTROLLER_NAMESPACE\ProfileController@update")->name('profile.update');
*/

Route::get('/users', "$CONTROLLER_NAMESPACE\UserController@index")->name('users.index');
Route::get('/user/{id}', "$CONTROLLER_NAMESPACE\UserController@show")->name('users.show');
Route::get('/user/{id}/edit', "$CONTROLLER_NAMESPACE\UserController@edit")->name('users.edit');
Route::post('/user/{id}/update', "$CONTROLLER_NAMESPACE\UserController@update")->name('users.update');
Route::post('/user/{id}/delete', "$CONTROLLER_NAMESPACE\UserController@destroy")->name('users.destroy');


Route::get('/profile/{username}', "$CONTROLLER_NAMESPACE\ProfileController@get")->name('profile.get');
Route::post('/profile/{username}/update_meta', "$CONTROLLER_NAMESPACE\ProfileController@update_meta")->name('profile.update_meta');






Route::get('/bootstrap', function () {
    return view('welcome');
});
