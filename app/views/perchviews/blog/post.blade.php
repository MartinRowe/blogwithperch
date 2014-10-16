<?php include('perch/runtime.php'); ?>
@extends('perchviews/blog/postGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/blog/post.blade.php');
?>

@section('postsection')
	<header class="layout-header">
		<div class="wrapper">
	
		</div>
		
	</header>
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
		   
		    
		    <div class="post">
		    	<?php perch_blog_post(perch_get('s')); ?>

		    	<?php perch_blog_author_for_post(perch_get('s')); ?>
		    	
		    	<div class="meta">
		            <div class="cats">
		                <?php perch_blog_post_categories(perch_get('s')); ?>
		            </div>
		            <div class="tags">
		                <?php perch_blog_post_tags(perch_get('s')); ?>

		                		    <!--  By year -->
		    <?php perch_blog_date_archive_years(); ?>
		    <!--  By year and then month - can take parameters for two templates. The first displays the years and the second the months see the default templates for examples -->
		    <?php perch_blog_date_archive_months(); ?>
		            </div>
		        </div>
		    	
		    	<?php perch_blog_post_comments(perch_get('s')); ?>
		    	
		    	<?php perch_blog_post_comment_form(perch_get('s')); ?>
		        
		    </div>
		</div>
		
		<nav class="sidebar">
		    <!-- <h2>Archive</h2>
		    The following functions are different ways to display archives. You can use any or all of these. 
		    
		    All of these functions can take a parameter of a template to overwrite the default template, for example:
		    
		    perch_blog_categories('my_template.html');
		    
		    --> 
		    <!--  By category listing -->
		 
    	</nav>
	</div>
	<footer class="layout-footer">
		<div class="wrapper">
			<small>Copyright &copy; <?php echo date('Y'); ?></small>
		</div>
	</footer>
	<?php perch_get_javascript(); ?>
@stop