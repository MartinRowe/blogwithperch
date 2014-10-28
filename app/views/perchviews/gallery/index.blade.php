<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/indexGrid')
<?php
PerchSystem::set_page('/gallery/index');
//echo $page = PerchSystem::get_page();
?>

@section('galleryIndex')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Gallery Examples</h1>
		    
		    <ul>
		        <li>Example A: <a href="example-a">Album listing</a> - great for using with a JavaScript lightbox</li>
		        <li>Example B: <a href="example-b">Single page gallery</a> - with more traditional HTML-only image pages</li>
		        <li>Example C: <a href="example-c">Album detail pages with lightbox effect</a></li>
		        <li>Example D: <a href="example-d">Album detail pages with slideshow</a></li>
		        <li>Example E: <a href="example-e">Image listing with pagination</a></li>
		    </ul>
		    
    	</div>
		
		
	</div>

	<?php perch_get_javascript(); ?>
@stop