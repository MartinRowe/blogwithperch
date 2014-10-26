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

// Bind Home route parameters for home page.
Route::model('home', 'Home');
Route::get('/', 'HomeController@home');
//Route::get('/example', 'HomeController@example');
Route::get('/search', 'HomeController@search');


// Perch List Detail Example
//Route::get('/listdetail', 'HomeController@listdetail');

// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('blog', 'Blog');
Route::get('/blog', 'BlogController@blogindex');
Route::get('/archive', 'BlogController@archive');
Route::any('/post', 'BlogController@post');


// Bind Perch Members route parameters for members page - what a hassle this has been.
Route::model('members', 'Members');
Route::any('/members/download', 'MembersController@download');
Route::any('/members', 'MembersController@index');
Route::any('members/logout', 'MembersController@logout');
Route::any('/logout', 'MembersController@logout');
Route::any('members/profile', 'MembersController@profile');
Route::any('/profile', 'MembersController@profile');
Route::any('/members/register', 'MembersController@register');
//Route::any('/register', 'MembersController@register');
Route::any('/members/reset', 'MembersController@reset');

Route::any('/members/login', 'MembersController@register');
Route::any('/members/register/login', 'MembersController@register');


// Non Perch, only Laravel
// Bind route parameters for blog page.
Route::model('post', 'Post');
// Show blog pages.
Route::get('/blogg', 'PostsController@mainindex');
Route::get('/blogg/create', 'PostsController@create');
Route::get('/blogg/edit/{post}', 'PostsController@edit');
Route::get('/blogg/delete/{post}', 'PostsController@delete');

Route::get('/head', 'PostsController@head');

// Handle blog form submissions.
Route::post('/blogg/create', 'PostsController@handleCreate');
Route::post('/blogg/edit', 'PostsController@handleEdit');
Route::post('/blogg/delete', 'PostsController@handleDelete');


// Bind route parameters for FAQ page.
Route::model('faq', 'FAQ');
Route::get('/faq', 'FAQController@faq');

// Bind route parameters for about page.
Route::model('about', 'About');
Route::get('/about', 'AboutController@about');
