<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/basicListingGrid')
<?php
PerchSystem::set_page('/events/basic-listing');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>


@section('basicListing')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Events Listing</h1>
			<p>This an example of the Perch Event Listing view.</p>
			<?php 
				perch_events_listing();
			?>		
		</div>

	</div>

	<?php perch_get_javascript(); ?>
@stop