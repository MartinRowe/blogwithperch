<?php

// app/controllers/PostsController.php

class GalleryController extends Controller
{



public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/index'); //new for 5.0
    }
    
}
