<?php

// app/controllers/PostsController.php

class MembersController extends Controller
{


public function download()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/download'); //new for 5.0
    }

public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/index'); //new for 5.0
    }
   
public function logout()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/logout'); //new for 5.0
    }

public function profile()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/profile'); //new for 5.0
    }

public function register()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/register'); //new for 5.0
    }
public function reset()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/reset'); //new for 5.0
    } 
public function login()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/members/reset'); //new for 5.0
    }
    
}
