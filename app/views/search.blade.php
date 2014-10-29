<?php include('perch/runtime.php'); ?>
@extends('searchGrid')

<?php
	PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/search.blade.php');
	// Set this so perch can recognise the page
	// $page = PerchSystem::get_page();
	// echo $page
?>



@section('searchPage')
		
	<?php perch_search_form(); ?>

@stop




@section('searchPageSearchSection')

    <?php 
		$query = perch_get('q');  // 'q' query string argument e.g. search.php?q=apples
	   // perch_content_search($query);
	    
	    perch_content_search($query, array(
	        'count'=>5,
	      //  'from-path'=>'/articles',
	        'excerpt-chars'=>300,
	        'template'=>'my-search-result.html'
	      ));
	
	?>

@stop

