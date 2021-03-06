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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/broadcast', function () {
    event(new \App\Events\PusherEvent('Great Wall is great ', '1'));
    return 'This is a Laravel Broadcaster Test!';
});

Route::get('email/verify/{token}',['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::get('users/{username}', function ($username){
    $client = new \Guzzle\Service\Client('https://api.github.com/');
    $response = $client->get("users/$username")->send();
    add($response, ['price' => 100]);
    dd($response->json());
});

Route::get('search/{query}', function ($query){
    return App::make('twitter')->search($query);
    // after add Facade
    // Twitter::do()
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('diary', 'DiaryController');

Route::get('diary/{diary}/follow', 'DiaryController@follow')->middleware('auth');
Route::get('notifications', 'NotificationsController@index')->middleware('auth');

Route::get('/avatar', 'UsersController@avatar');
