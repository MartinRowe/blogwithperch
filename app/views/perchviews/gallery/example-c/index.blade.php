<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-c/examplec_indexGrid')

<?php
	PerchSystem::set_page('/gallery/example-c/index');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('galleryIndexc')


    <h2>Gallery with a lightbox</h1>
    
    <p>Simple lightbox example using the <a href="http://jacklmoore.com/colorbox/">ColorBox</a> jQuery plugin.</p>

@stop



@section('galleryIndexcAlbumList')

    <ul class="albumdisplay glist">
    <?php 
        perch_gallery_albums(array(
            'template'=>'c_album-image.html',
            'image'=>true
        )); 
    ?>
    </ul>

	<?php perch_get_javascript(); ?>
@stop