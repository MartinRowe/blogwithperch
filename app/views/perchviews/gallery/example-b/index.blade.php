<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-b/exampleb_indexGrid')

<?php
	PerchSystem::set_page('/gallery/example-b/index');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}"> <!-- Not sure if need this -->
</head>


@section('galleryIndexb')
	
	<h2>Example B: single page gallery</h2>

    <p>A simple gallery listing: albums displayed as headings - thumbnails underneath
     on one page. Click a thumbnail to view a larger image.</p>
    

    <?php perch_gallery_build(); ?>

	<?php perch_get_javascript(); ?> <!-- Not sure if need this -->
@stop
