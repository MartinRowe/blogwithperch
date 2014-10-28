<?php

// app/controllers/PostsController.php

class GallerydController extends Controller
{


// /gallerya/exampleaAlbum
public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-d/index'); //new for 5.0
    }
   
public function albumd()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-d/albumd'); //new for 5.0
    }
    
}
