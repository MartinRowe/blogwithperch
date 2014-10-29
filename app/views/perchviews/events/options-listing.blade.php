<?php include('perch/runtime.php'); ?>
@extends('perchviews/events/optionsListingGrid')
<?php
	PerchSystem::set_page('/options-listing');
	//echo $page = PerchSystem::get_page();
?>



@section('optionsListing')

	<h1>Events Listing</h1>

	<?php 
		/**
		 * Change the categories listed to one or more which exist in your admin.
		 */
		perch_events_listing(array(
		    'past-events'=>true,
		    'category'=>array('one', 'two')
		));
	?>	

	<?php perch_get_javascript(); ?>
@stop