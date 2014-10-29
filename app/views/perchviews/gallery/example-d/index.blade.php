<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-d/exampled_indexGrid')

<?php
	PerchSystem::set_page('/gallery/example-d/index');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('galleryIndexd')
	
    <h2>Gallery with a slideshow</h2>
    
    <p>Simple slideshow example using the <a href="http://jquery.malsup.com/cycle/">Cycle</a> jQuery plugin.</p>
    
    <ul class="glist albumdisplay">
    <?php 
        perch_gallery_albums(array(
            'template'=>'d_album-image.html',
            'image'=>true
        )); 
    ?>
    </ul>
		
	<?php perch_get_javascript(); ?>

@stop
