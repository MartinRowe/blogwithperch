<?php

// app/routes.php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Register all of the routes for the application.
|
*/

// Bind Home route parameters for home page.
Route::model('home', 'Home');
Route::get('/', 'HomeController@home');
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


// Bind Perch Events route parameters for event page - what a hassle this has been.
Route::model('events', 'Events');
Route::get('/events', 'EventsController@eventsIndex');
Route::get('/events/archive', 'EventsController@archive');
Route::get('/basic-calendar', 'EventsController@basiccalendar');
Route::get('/basic-listing', 'EventsController@basiclisting');
Route::get('/events/event', 'EventsController@event');
Route::get('/events-custom', 'EventsController@eventscustom');
Route::get('/options-calendar', 'EventsController@optionscalendar');
Route::get('/options-listing', 'EventsController@optionslisting');



// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('gallery', 'Gallery');
Route::get('/gallery', 'GalleryController@index');
//Route::get('/gallery/exampleaAlbum', 'GalleryController@album');
//Route::any('/post', 'GalleryController@post');

// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('gallerya', 'Gallerya');
Route::get('/example-a', 'GalleryaController@index');
Route::any('/albuma', 'GalleryaController@albuma');
Route::any('/image', 'GalleryaController@image');

// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('galleryb', 'Galleryb');
Route::get('/example-b', 'GallerybController@index');
//Route::any('/example-b/album', 'GallerybController@album');
Route::any('/image', 'GallerybController@image');

// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('galleryc', 'Galleryc');
Route::get('/example-c', 'GallerycController@index');
Route::any('/albumc', 'GallerycController@albumc');


// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('galleryd', 'Galleryd');
Route::get('/example-d', 'GallerydController@index');
Route::any('/albumd', 'GallerydController@albumd');

// Bind Perch Blog route parameters for blog page - what a hassle this has been.
Route::model('gallerye', 'Gallerye');
Route::get('/example-e', 'GalleryeController@index');



// Bind route parameters for FAQ page.
Route::model('faq', 'FAQ');
Route::get('/faq', 'FAQController@faq');



// Bind route parameters for about page.
Route::model('about', 'About');
Route::get('/about', 'AboutController@about');







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



