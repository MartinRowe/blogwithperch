<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-a/examplea_indexGrid')
<?php
PerchSystem::set_page('/gallery/example-a/index');
//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<title><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> - Perch Gallery Example A</title>
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>

@section('galleryIndexa')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		    <h1>Example A: gallery</h1>
		
		    <p>This demonstrates a simple gallery listing. Albums are listed in the navigation and also below using the optional ability to display a thumbnail for the album. 
		    Clicking on any album takes you to the page for that album where thumbnails are displayed. Click a thumbnail to view a larger image.</p>
		    <ul class="glist albumdisplay">
		    <?php 
		        perch_gallery_albums(array(
		            'template'=>'a_album-image.html',
		            'image'=>true
		        )); 
		    ?>
		    </ul>
		
	    	
		

		</div>
		<nav class="sidebar">
			<h2>Albums</h2>
		    <ul class="glist albums">
		    	<?php perch_gallery_albums(); ?>
		    </ul>

		</nav>
		
	</div>

	<?php perch_get_javascript(); ?>
@stop