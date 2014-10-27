<?php

// app/controllers/EventsController.php

class EventsController extends Controller
{



public function eventsIndex()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/eventsIndex'); //new for 5.0
    }
public function archive()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/archive'); //new for 5.0
    }

public function basiccalendar()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/basic-calendar'); //new for 5.0
    }

public function basiclisting()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/basic-listing'); //new for 5.0
    }

public function event()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/event'); //new for 5.0
    }

public function eventscustom()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/events-custom'); //new for 5.0
    } 

public function optionscalendar()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/options-calendar'); //new for 5.0
    }

public function optionslisting()
    {
        // Show the create post form.
        //return View::make('blog/index');
        return View::make('perchviews/events/options-listing'); //new for 5.0
    }


}


