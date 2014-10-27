<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/eventsCustomGrid')
<?php
PerchSystem::set_page('/events-custom');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('eventsCustom')

	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Example Custom Event Listing</h1>

			<p>You can completely customise the information that is returned. This enables you to filter between dates, and select how many events to display rather than show a month at a time. This can be useful to display a listing of the next few events on a homepage for example.</p>
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
		</div>

		<nav class="sidebar">
		    <!--  By category listing -->
		    <?php perch_events_categories(); ?>
    	</nav>
		
		
	</div>


	<?php perch_get_javascript(); ?>
@stop