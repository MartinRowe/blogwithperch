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
 public function blogindex()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/Blog/blogindex'); //new for 5.0
    }
public function archive()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/Blog/archive'); //new for 5.0
    }

// list view section
public function listdetail()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/listdetail/products'); //new for 5.0
    }
    
}
