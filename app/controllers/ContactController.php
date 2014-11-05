<?php

// app/controllers/PostsController.php

class ContactController extends Controller
{

    public function index()
    {
        // Show the create post form.
        return View::make('perchviews/contact/contact');
        //return view('create'); //new for 5.0
    }
    
}