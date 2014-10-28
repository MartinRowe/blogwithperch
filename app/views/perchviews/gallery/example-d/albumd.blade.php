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
</head>

@section('gallerydStuff')

<body>
	<p><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> -Perch Gallery Example A</p>

	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
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
    	</div>
    	<nav class="sidebar">
	    	<h2>Albums</h2>
		    <ul class="glist albums">
		    	<?php perch_gallery_albums(array(
    'template' => 'dalbum.html',
    'image' => true,
)); ?>
		    </ul>
		</nav>
	</div>


	<?php perch_get_javascript(); ?>
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