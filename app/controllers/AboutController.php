<?php

// app/controllers/PostsController.php

class AboutController extends Controller
{

    public function about()
    {
        // Show the create post form.
        return View::make('about');
        //return view('create'); //new for 5.0
    }
    
}