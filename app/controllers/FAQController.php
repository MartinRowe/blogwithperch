<?php

// app/controllers/PostsController.php

class FAQController extends Controller
{

    public function faq()
    {
        // Show the create post form.
        return View::make('faq');
        //return view('create'); //new for 5.0
    }

}
