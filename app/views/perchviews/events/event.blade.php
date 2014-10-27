<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/eventGrid')
<?php
PerchSystem::set_page('/events/event');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>



@section('theEvent')

<?php 
	//we can get the event Title using perch_events_event_field
	$title = perch_events_event_field(perch_get('s'),'eventTitle',true); 
?>


	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Event</h1>
			<?php 		
				perch_events_custom(array(
					'filter'=>'eventSlug',
					'match'=>'eq',
					 'value' => $_GET['event'], 
					'template'=>'listing/event-detail.html'
				));
			?>			
		</div>

		<nav class="sidebar">
		    <!--  By category listing -->
		    <?php perch_events_event_categories(perch_get('s')); ?>

    	</nav>

	</div>

	<?php perch_get_javascript(); ?>
@stop