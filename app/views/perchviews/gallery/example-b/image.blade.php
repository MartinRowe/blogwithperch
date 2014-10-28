<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-b/exampleb_imageGrid')
<?php
PerchSystem::set_page('/gallery/example-b/image');
//echo $Settings->get('perch_members_login_page')->settingValue();
echo $page = PerchSystem::get_page();
?>
<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>
@section('imagebStuff')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">	
			<?php 
				perch_gallery_image(perch_get('id'));
			?>
			<p><a href="/example-b">&laquo; Back to listing</a></p>
    	</div>
    	
		<nav class="sidebar">
			<ul class="albums glist">
			<?php 
    			perch_gallery_adjacent_images(perch_get('id'));
    		?>
			</ul>
		</nav>
		
	</div>

	<?php perch_get_javascript(); ?>
@stop