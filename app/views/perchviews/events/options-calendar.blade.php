<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/optionsCalendarGrid')
<?php
PerchSystem::set_page('/events/options-calendar');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('optionsCalendar')


	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		<h1>Example Calendar</h1>
		
		<p>This an example of the Perch Events Calendar with options passed in. These options allow past events, and filter to show only named categories.</p>
		<?php 
			/**
			 * setting options for the calendar. Change the categories listed to one or more which exist in your admin.
			 */
			perch_events_calendar(array(
			    'past-events'=>true,
			    'category'=>array('one', 'two')
			));
		?>
		</div>
		
		
	</div>

		
	</div>
	<?php perch_get_javascript(); ?>
@stop