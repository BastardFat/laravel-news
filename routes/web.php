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

use App\Mail\AccountConfirmationMail;
use App\User;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect('/news');
});

Route::get('/unconfirmed', function () {
    return view('unconfirmed');
});


Route::get('/news', 'HomeController@news');

Route::get('/news/{id}', 'HomeController@newsbyid');

Route::get('/post', 'HomeController@post');
Route::post('/save', 'HomeController@save');

Route::post('/addcomment', 'HomeController@addcomment');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/confirmaccount/{token}', function ($token)
{
    $id = explode('-',$token)[0];
    $confirmation_token = explode('-',$token)[1];
    if(User::find($id)->confirmation_token == $confirmation_token)
    {
        $user = User::find($id);
        $user->confirmed = true;
        $user->save();
    }
    return redirect('/news');
});

Route::get('/test', function()
{
   dd(url('/news'));
});

Route::feeds();
