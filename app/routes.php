<?php

// app/routes.php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Bind route parameters for home page.
Route::model('home', 'Home');
Route::get('/', 'HomeController@home');


// Bind route parameters for blog page.
Route::model('post', 'Post');

// Show blog pages.
Route::get('/blog', 'PostsController@index');
Route::get('/blog/create', 'PostsController@create');
Route::get('/blog/edit/{post}', 'PostsController@edit');
Route::get('/blog/delete/{post}', 'PostsController@delete');

// Handle blog form submissions.
Route::post('/blog/create', 'PostsController@handleCreate');
Route::post('/blog/edit', 'PostsController@handleEdit');
Route::post('/blog/delete', 'PostsController@handleDelete');


// Bind route parameters for FAQ page.
Route::model('faq', 'FAQ');
Route::get('/faq', 'FAQController@faq');

// Bind route parameters for about page.
Route::model('about', 'About');
Route::get('/about', 'AboutController@about');

