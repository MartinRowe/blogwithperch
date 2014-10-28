<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-c/examplec_albumGrid')
<?php
PerchSystem::set_page('/gallery/example-c/album');
echo $page = PerchSystem::get_page();
?>
<head>

	<title><?php perch_gallery_album_field(perch_get('s'), 'albumTitle'); ?> - My Perch Gallery Example C</title> 
	<?php perch_get_css(); ?>
		<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
<!--	<link rel="stylesheet" type="text/css" href="css/gallery.css" /> -->
<!--	<link rel="stylesheet" type="text/css" href="css/colorbox.css" /> -->

<!--
 {{HTML::style('css/style.css');}}
 {{HTML::style('css/gallery.css');}}
 {{HTML::style('css/colorbox.css');}}
 {{HTML::script('js/jquery-1.8.2.min.js')}}
 {{HTML::script('js/jquery.colorbox-min.js')}}
-->

</head>

@section('gallerycStuff')

	
 <?php  echo public_path(); ?>

	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<?php 
			if(perch_get('s')) {
				perch_gallery_album_images(perch_get('s'));
			} ?>
		</div>
    	<nav class="sidebar">
			<h2>Albums</h2>
		    <ul class="glist albums">
		    	<?php perch_gallery_albums(); ?> 
		    </ul>
		</nav>
	</div>

<?php perch_get_javascript(); ?>
<!-- <script type="text/javascript" src="{{ asset('js/jquery/jquery-1.8.2.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/jquery.colorbox-min.js') }}"></script> -->
<!-- <script type="text/javascript" src='{{ asset('jquery.colorbox-min.js') }}'></script> -->
<!-- or e.g. -->

<!-- {{ HTML::script('js/jquery/jquery-1.8.2.min.js') }} -->


	<!-- script src='{{url('assets/js/plugins/colorbox.js')}}'> -->
<!--	<script type="text/javascript" src='{{url('jquery.colorbox-min.js')}}'></script> -->
<!-- {{HTML::script('jquery.colorbox-min.js')}} -->
<!-- {{HTML::script('/js/jquery.colorbox-min.js')}} -->


<!-- <script type="text/javascript" src="jquery.colorbox-min.js"></script> --> 
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
	<script type="text/javascript" src="{{asset('js/jquery.colorbox-min.js')}}"></script>
	<script type="text/javascript" charset="utf-8">
	   jQuery(function($){
           $('a.gallery').colorbox();
	   });
	</script>

@stop