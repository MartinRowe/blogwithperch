<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/eventsCustomGrid')
<?php
PerchSystem::set_page('/events-custom');
//echo $page = PerchSystem::get_page();
?>

@section('eventsCustom')

	<h1>Custom Event Listing</h1>
	<p>You can completely customise the information that is returned. 
		This enables you to filter between dates, and select how many 
		events to display rather than show a month at a time. 
		This can be useful to display a listing of the next few events
		on a homepage for example.</p>
			
		<?php 
			perch_events_custom(array(
	            'filter'=>'eventDateTime',
				'match'=>'gte',
				'value'=>date('Y-m-d'),
				'count'=>3,
				'sort'=>'eventDateTime',
				'sort-order'=>'desc',
	    		'template'=>'listing/custom-listing-day.html'
            ));
		?>

	<nav class="sidebar">
		<!--  By category listing -->
		<?php perch_events_categories(); ?>
    </nav>

	<?php perch_get_javascript(); ?>
@stop