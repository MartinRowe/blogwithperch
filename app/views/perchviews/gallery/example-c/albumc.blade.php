<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-c/examplec_albumGrid')

<?php
	PerchSystem::set_page('/gallery/example-c/albumc');
	//echo $page = PerchSystem::get_page();
?>


<head>
    <meta charset="utf-8" />
	<title><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> - Perch Gallery Example C</title>
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('gallerycStuff')
<body>

	<?php 
	if(perch_get('s')) {
		perch_gallery_album_images(perch_get('s'), array(
    	   'template'   =>'c_list_image.html'
    	));
	} ?>
@stop


@section('gallerycStuffAlbumList')



	<h2>Albums</h2>
    <ul class="albums glist">
		<?php perch_gallery_albums(array(
		    'template' => 'calbum.html',
		    'image' => true,
		)); ?>
    </ul>

@stop

	<?php perch_get_javascript(); ?>

	<!-- Be very careful -->
		<script type="text/javascript" src="{{asset('js/jquery.colorbox-min.js')}}"></script>	
<!--	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script> -->
	<script type="text/javascript" charset="utf-8">
	   jQuery(function($){
           $('a.gallery').colorbox();
	   });
	</script>
</body>
</html>