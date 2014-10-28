<?php

// app/controllers/PostsController.php

class GallerycController extends Controller
{


// /gallerya/exampleaAlbum
public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-c/index'); //new for 5.0
    }
   
public function albumc()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-c/albumc'); //new for 5.0
    }
    
}
