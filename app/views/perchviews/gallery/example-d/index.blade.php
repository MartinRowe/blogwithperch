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
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		    <h1>Example D: gallery with a slideshow</h1>
		    
		    <p>This is a simple slideshow example using the <a href="http://jquery.malsup.com/cycle/">Cycle</a> jQuery plugin.</p>
		    
		    <ul class="glist albumdisplay">
		    <?php 
		        perch_gallery_albums(array(
		            'template'=>'d_album-image.html',
		            'image'=>true
		        )); 
		    ?>
		    </ul>
		</div>
	</div>

	<?php perch_get_javascript(); ?>
@stop
