<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/indexGrid')
<?php
PerchSystem::set_page('/events/eventsIndex');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('indexStuff')
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		<h1>Events Example Pages</h1>
		
		
	   
		<p>These pages are examples of how to use the events functionality on your pages. Install the Events add-on and add some events and categories, then try the links below to see the kind of pages you can create. Simply copy the functions into your own site design.</p>
		
		<ul>
			<li><a href="basic-calendar">Basic calendar</a></li>
			<li><a href="options-calendar">Calendar with options</a></li>
			<li><a href="basic-listing">Basic listing</a></li>
			<li><a href="options-listing">Listing with options</a></li>
			<li><a href="events-custom">Using events custom to display a listing with a detail page</a></li>
		</ul>
		
		</div>
		
		
	</div>
	<?php perch_get_javascript(); ?>
@stop
