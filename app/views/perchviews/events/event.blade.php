<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/eventGrid')
<?php
PerchSystem::set_page('/events/event');
//echo $page = PerchSystem::get_page();
?>


@section('theEvent')

<?php 
	//we can get the event Title using perch_events_event_field
	$title = perch_events_event_field(perch_get('s'),'eventTitle',true); 
?>


<h1>Event</h1>
<?php 		
	perch_events_custom(array(
	'filter'=>'eventSlug',
	'match'=>'eq',
	'value' => $_GET['event'], 
	'template'=>'listing/event-detail.html'
	));
?>			

		<nav class="sidebar">
		    <!--  By category listing -->
		    <?php perch_events_event_categories(perch_get('s')); ?>

    	</nav>

	<?php perch_get_javascript(); ?>
@stop