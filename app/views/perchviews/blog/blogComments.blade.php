<?php include('perch/runtime.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Comments Example</title>
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php" />
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="comments.css" type="text/css" />
</head>
<body>
	<header class="layout-header">
		<div class="wrapper">
			<div class="company-name">Perch Comments App - Company Name</div>
			<img src="<?php perch_path('feathers/quill/img/logo.gif'); ?>" alt="Your Logo Here" class="logo"/>
		</div>
		<nav class="main-nav">
			<?php perch_pages_navigation(array(
					'levels'=>1
				));
			?>
		</nav>
	</header>
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Comments Example</h1>

			<p>The Comments app enables you to add comments to all sorts of content. To add comments to an item, you need to be able to uniquely identify the thing the comments are about.</p>
			<p>That identifier might be with an existing ID for the item (like a product ID for a product, or an article ID for an article), or something you make up. The item ID is then used whenever you need to do anything with comments for that item, be that displaying comments, the comment form or getting the comment count.</p>

			<p>Existing database IDs are perfect for this - but as identifiers need to be unique within your site, we'd recommend prefixing a database ID with something to identify the sort of item it is. For example, a product might have a database ID of <code>123</code>, but for comments you should use <code>product123</code> to make it distinct from <code>post123</code> and <code>photo123</code>.</p>

			<p>The example below uses the ID <code>example1</code>. It has <?php perch_comments_count('example1'); ?> comments.</p>

		    <?php
		    	perch_comments('example1');
		    	perch_comments_form('example1', 'Comments Example');
		    ?>
		</div>
		
		<nav class="sidebar">

    	</nav>
	</div>
	<footer class="layout-footer">
		<div class="wrapper">
			<ul class="social-links">
				<li class="twitter"><a href="#" rel="me">Twitter</a></li>
				<li class="facebook"><a href="#" rel="me">Facebook</a></li>
				<li class="flickr"><a href="#" rel="me">Flickr</a></li>
				<li class="linkedin"><a href="#" rel="me">LinkedIn</a></li>
				<li class="rss"><a href="#">RSS</a></li>
			</ul>
			<small>Copyright &copy; 2013</small>
		</div>
	</footer>
	<?php perch_get_javascript(); ?>
</body>
</html>


    
