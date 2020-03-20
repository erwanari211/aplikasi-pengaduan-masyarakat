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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('feedback', 'FeedbackController@index')
    ->name('feedback.index');

Route::get('feedback/create', 'FeedbackController@create')
    ->name('feedback.create')
    ->middleware('auth');

Route::post('feedback/', 'FeedbackController@store')
    ->name('feedback.store')
    ->middleware('auth');

Route::get('feedback/{feedback}', 'FeedbackController@show')
    ->name('feedback.show');

Route::post('feedback/{feedback}/response', 'ResponseController@store')
    ->name('feedback.responses.store')
    ->middleware('auth');
