<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-e/examplee_indexGrid')

<?php
	PerchSystem::set_page('/gallery/example-e/index');
	//echo $page = PerchSystem::get_page();
?>

<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>


@section('galleryIndexe')
	
    <h2>Image listing with pagination</h2>
    
    <?php  
        $opts = array(
            'count'=>5,
            'paginate'=>true
        );
    
    	//    perch_gallery_images($opts);
    	perch_gallery_images(array(
    	'template' => 'e_list_image.html',
		)); 
    ?>


	<?php perch_get_javascript(); ?>
@stop