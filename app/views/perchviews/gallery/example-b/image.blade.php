<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-b/exampleb_imageGrid')

<?php
	PerchSystem::set_page('/gallery/example-b/image');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('imagebStuff')
	
	<?php 
		perch_gallery_image(perch_get('id'));
	?>
	<p><a href="/example-b">&laquo; Back to previous listing</a></p>

@stop



@section('imagebStuffNextPrevious')

	<ul class="albums glist">
	<?php 
		perch_gallery_adjacent_images(perch_get('id'));
	?>
	</ul>

	<?php perch_get_javascript(); ?>
@stop