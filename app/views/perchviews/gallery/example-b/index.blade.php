<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-b/exampleb_indexGrid')
<?php
PerchSystem::set_page('/gallery/example-b/index');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>
@section('galleryIndexb')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">		    
			<h1>Example B: single page gallery</h1>
		
		    <p>This demonstrates a simple gallery listing. With albums displayed as headings - thumbnails underneath on one page.
		    Click a thumbnail to view a larger image.</p>
		    
		    <?php perch_gallery_build(); ?>
		</div>
		
		
	</div>


	<?php perch_get_javascript(); ?>
@stop
