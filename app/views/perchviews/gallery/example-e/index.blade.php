<?php include('perch/runtime.php'); ?>
@extends('perchviews/gallery/example-e/examplee_indexGrid')
<?php
PerchSystem::set_page('/gallery/example-e/index');
//echo $Settings->get('perch_members_login_page')->settingValue();
echo $page = PerchSystem::get_page();
?>
<head>
    <meta charset="utf-8" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
	<link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
</head>

@section('galleryIndexe')
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		    <h1>Example E: image listing with pagination</h1>
		    
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
            
		</div>
	</div>

	<?php perch_get_javascript(); ?>
@stop