<?php

// app/controllers/BlogController.php
// Perch Blog Controller
class BlogController extends Controller
{

public function blogindex()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/blog/blogindex'); //new for 5.0
    }

public function archive()
    {
        // Show the create archive form.
        return View::make('perchviews/blog/archive'); //new for 5.0
    }

public function post()
    {
        // Show the posts.
        return View::make('perchviews/blog/post'); //new for 5.0
    }
    
}
