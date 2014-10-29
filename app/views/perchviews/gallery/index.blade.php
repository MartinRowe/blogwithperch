<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/indexGrid')

<?php
	PerchSystem::set_page('/gallery/index');
	//echo $page = PerchSystem::get_page();
?>


@section('galleryIndex')
	
	<h2>Gallery Examples</h2>
    
    <ul>
        <li>Example A: <a href="example-a">Album listing</a> - good for using with a JavaScript lightbox</li>
        <li>Example B: <a href="example-b">Single page gallery</a> - with more traditional HTML-only image pages</li>
        <li>Example C: <a href="example-c">Album detail pages with lightbox effect</a></li>
        <li>Example D: <a href="example-d">Album detail pages with slideshow effect</a></li>
        <li>Example E: <a href="example-e">Image listing with pagination</a></li>
    </ul>
    

	<?php perch_get_javascript(); ?>
@stop