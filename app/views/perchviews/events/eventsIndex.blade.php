<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/indexGrid')
<?php
	PerchSystem::set_page('/events/eventsIndex');
	//echo $page = PerchSystem::get_page();
?>

@section('indexStuff')
	
	<h1>Events Pages</h1>
	<p>
		Diffferent Listing and Calendar Options
	</p>
			
	<ul>
		<li><a href="basic-calendar">Basic calendar</a></li>
		<li><a href="options-calendar">Calendar with options</a></li>
		<li><a href="basic-listing">Basic listing</a></li>
		<li><a href="options-listing">Listing with options</a></li>
		<li><a href="events-custom">Using events custom to display a listing with a detail page</a></li>
	</ul>

	<?php perch_get_javascript(); ?>

@stop

@section('myNavStacked')
 <ul class="nav  nav--stacked">
       <li><a href=#>Home</a></li>
       <li><a href=#>About</a></li>
       <li><a href=#>Portfolio</a></li>
       <li><a href=#>Contact</a></li>
   </ul>
@stop