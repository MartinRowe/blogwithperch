<?php

// app/controllers/PostsController.php

class GalleryeController extends Controller
{


// /gallerya/exampleaAlbum


public function index()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-e/index'); //new for 5.0
    }

public function album()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/gallery/example-e/album'); //new for 5.0
    }
    

}