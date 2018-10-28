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
//questions
Route::resource('questions', 'QuestionController')->except('show');
Route::get('/questions/{slug}' , 'QuestionController@show')->name('questions.show');
// questions.answers
Route::resource('questions.answers', 'AnswerController')->except('index','create','show');
Route::post('/questions/answers/{answer}/best_answer', 'AnswerController@bestAnswer')->name('answers.best_answer');
// favorite questions
Route::post('/questions/{question}/favorites', 'FavoriteController@store')->name('favorite.store');
Route::delete('/questions/{question}/favorites', 'FavoriteController@destroy')->name('favorite.destroy');
