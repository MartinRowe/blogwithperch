<?php include('perch/runtime.php'); ?>
@extends('perchviews/blog/blogGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/blog/blogindex.blade.php');
?>

@section('blogRecentPosts')

	<?php perch_content('BlogStuff'); ?>
			<!-- this is an example blog homepage showing a simple call to perch_blog_recent_posts()
			
			Posts are displayed using the templates stored in perch/apps/perch_blog/templates/blog
			you can edit these as you wish, making sure that the check paths -->

		    <?php 
		        perch_blog_recent_posts(10);
		    ?>
	    
		    
	 <a href="{{ action('BlogController@archive') }}" >More Posts</a>
		  <!--  <p><a href="archive.php">More posts</a></p> -->
@stop

@section('blogContent')
	<?php perch_content('BlogIntro'); ?>
@stop
