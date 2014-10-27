<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/archiveGrid')
<?php
PerchSystem::set_page('/events/archive');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('archiveStuff')

	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<?php
				perch_events_category(perch_get('cat'));
			?>

			<p>This shows events by category, and then filtered by date.</p>

			<h2>Upcoming events</h2>

			<?php 
			 	perch_events_custom(array(
					'category'   => perch_get('cat'),
					'filter'     => 'eventDateTime',
					'match'      => 'gte',
					'value'      => date('Y-m-d'),
					'sort'       => 'eventDateTime',
					'sort-order' => 'desc',
					'template'   => 'listing/custom-listing-day.html'
	            ));
			?>

			<h2>Past events</h2>

			<?php 
			 	perch_events_custom(array(
					'category'   => perch_get('cat'),
					'filter'     => 'eventDateTime',
					'match'      => 'lt',
					'value'      => date('Y-m-d'),
					'sort'       => 'eventDateTime',
					'sort-order' => 'desc',
					'template'   => 'listing/custom-listing-day.html'
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




