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

Route::resource('tutorial', 'TutorialController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::resource('/post', 'PostController');
Route::get('/user/{id}', 'UserController@show');
Route::resource('user', 'UserController');
Route::resource('comments', 'CommentsController');
Route::resource('message', 'MessageController');
Route::resource('like', 'LikeController');
Route::resource('workshop', 'WorkshopController');
Route::post('tutoriallike', 'TutorialLikeController@like');
Route::post('tutorialdislike', 'TutorialLikeController@dislike');
Route::get('/chat', 'MessageController@index');
Route::get('chat/send', 'MessageController@store');
Route::post('mail/send', 'MailController@send');
Route::get('mails/mailsended', 'MailController@mailsended');
Route::post('/post', 'PostController@order');
Route::post('/tutorial', 'TutorialController@search');
Route::post('/workshop{id}', 'WorkshopController@join');
Route::post('/worksho{id}', 'WorkshopController@leave');