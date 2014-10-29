<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-d/exampled_albumGrid')

<?php
	PerchSystem::set_page('/gallery/example-d/albumd');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
	<title><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> -Gallery Example D</title>
</head>

@section('gallerydStuff')

			<?php 
			if(perch_get('s')) {

                // Output the large images
				perch_gallery_album_images(perch_get('s'), array(
            	   'template'   =>'d_list_image.html'
            	));
				
				// Output the small images used for navigation
				perch_gallery_album_images(perch_get('s'), array(
            	   'template'   =>'d_nav_image.html',
            	));
			}			 
			?>
@stop

@section('gallerydStuffAlbums')

	    	<h2>Albums</h2>
		    <ul class="glist albums">
			    <?php perch_gallery_albums(array(
					    'template' => 'dalbum.html',
	    				'image' => true,
				));
				?>
		    </ul>

	<?php perch_get_javascript(); ?>
	
<!-- Code below an alternative way to do what lightbox does with Gallery C -->
	<script type="text/javascript" src="<?php echo URL::to('/js/jquery.cycle.all.js')?>"></script>
<!--	<script type="text/javascript" src="jquery.cycle.all.js"></script> -->
	<script type="text/javascript" charset="utf-8">
	   jQuery(function($){
	       var navlinks = $('ul.slideshow-nav a').get();
           $('ul.slideshow').cycle({
               pager:'ul.slideshow-nav', 
               pagerAnchorBuilder: function(i){return navlinks[i];}
           });
	   });
	</script>
</body>
@stop