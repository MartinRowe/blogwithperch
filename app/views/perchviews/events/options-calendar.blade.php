<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/optionsCalendarGrid')

<?php
	PerchSystem::set_page('/events/options-calendar');
	//echo $page = PerchSystem::get_page();
?>


@section('optionsCalendar')

		<h1>Example Calendar</h1>
		
		<p>Events Calendar with options passed in.
			These options allow past events, and filter to show only named categories.</p>
		<?php 
			/**
			 * setting options for the calendar. Change the categories listed to one or more which exist in your admin.
			 */
			perch_events_calendar(array(
			    'past-events'=>true,
			    'category'=>array('one', 'two')
			));
		?>

	<?php perch_get_javascript(); ?>
@stop