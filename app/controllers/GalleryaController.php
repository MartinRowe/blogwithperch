<?php

// app/controllers/PostsController.php

class GalleryaController extends Controller
{


// /gallerya/exampleaAlbum
public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-a/index'); //new for 5.0
    }
   
public function albuma()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-a/albuma'); //new for 5.0
    }
public function image()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-a/image'); //new for 5.0
    }
    
}
