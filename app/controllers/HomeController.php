<?php

// app/controllers/PostsController.php

class HomeController extends Controller
{

    public function home()
    {
        // Show the create post form.
        return View::make('home');
        //return view('create'); //new for 5.0
    }

    public function example()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('example'); //new for 5.0
    }
    public function search()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('search'); //new for 5.0
    }


    
}
