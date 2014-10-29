<?php include('perch/runtime.php'); ?>
@extends('perchviews/blog/postGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/blog/post.blade.php');
?>


@section('postsection')

		    
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
		    				<!-- By year and then months - can take parameters for two templates.
		    				The first displays the years and the second the months see the
		    				default templates for examples
		    				-->
		    				<?php perch_blog_date_archive_months(); ?>
	            		</div>
				
		    	<!-- Show blog comments -->
		    	<?php perch_blog_post_comments(perch_get('s')); ?>
		    	<!-- Show form for entering comments -->
		    	<?php perch_blog_post_comment_form(perch_get('s')); ?>
		    	</div>
			</div>


	<?php perch_get_javascript(); ?>
@stop