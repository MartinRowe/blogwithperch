<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/basicCalendarGrid')
<?php
PerchSystem::set_page('/events/basic-calendar');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>


<!--	<link rel="stylesheet" href="events.css" type="text/css" /> -->
	   
	
@section('basicCalendar')

	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols8-nav-right">
	
		<div class="primary-content">
		<h1>Example Calendar</h1>
		
		
		<p>This an example of the Perch Events Calendar.</p>
		<?php 
			perch_events_calendar();
		?>
		</div>
		
		
	</div>
	<?php perch_get_javascript(); ?>
@stop