<?php

// app/controllers/PostsController.php

class GallerybController extends Controller
{


// /gallerya/exampleaAlbum
public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-b/index'); //new for 5.0
    }
   

public function image()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-b/image'); //new for 5.0
    }
     
}
