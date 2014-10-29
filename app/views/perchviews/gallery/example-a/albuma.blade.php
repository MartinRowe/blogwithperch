<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-a/examplea_albumGrid')

<?php
	PerchSystem::set_page('/gallery/example-a/albuma');
	//echo $page = PerchSystem::get_page();
?>


<head>
    <meta charset="utf-8" />
	<title><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> -Perch Gallery Example A</title>
	<?php perch_get_css(); ?>
 {{HTML::style('css/style.css');}} <!-- Do I need this ???? -->
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('galleryaStuff')

<body>
   
	<?php 
	if(perch_get('s')) {
		perch_gallery_album_images(perch_get('s'));
	} ?>

@stop

@section('galleryaListing')

	<h2>Albums</h2>
    <ul class="glist albums">
    	<?php perch_gallery_albums(); ?>
    </ul>

	
	<?php perch_get_javascript(); ?>

@stop