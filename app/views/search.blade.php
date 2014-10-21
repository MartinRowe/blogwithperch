<?php include('perch/runtime.php'); ?>
@extends('searchGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/search.blade.php');
?>

@section('searchSection')
	<div class="wrapper cols2-nav-right">
		<div class="primary-content">
		    <?php 
				$query = perch_get('q');  // 'q' query string argument e.g. search.php?q=apples
			    perch_content_search($query);
			?>
		</div>
		<nav class="sidebar">
		   <?php perch_search_form(); ?>
    	</nav>
	</div>
    <?php perch_get_javascript(); ?>
@stop