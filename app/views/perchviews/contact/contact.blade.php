<?php include('perch/runtime.php'); ?>
@extends('perchviews/contact/contactGrid')

<?php
	PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/contact/contact.blade.php');
?>
@section('contactStuff')
<head>

    <title>Contact | Swift Migrations</title>
	<?php perch_page_attributes(); ?>
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/favicon.ico">
</head>

<body class="contact">

	<header class="site-header" role="banner">
		<h1 class="site-title"><a href="/">Swift Migrations</a></h1>
		<h2 class="site-description">Helping you get your flock from A to B</h2>
	</header>		
		<div class="masthead">
			<div class="masthead-inner">
				<?php perch_content('Contact Form'); ?>
			</div>
		</div>
		<div class="main" role="main">
			<?php perch_content('Contact'); ?>
		<div class="img map">
		    <?php perch_content('Map'); ?>
		</div>
	</div>
	<footer class="site-footer">
		<div class="footer">
			<?php perch_content('Contact'); ?>
		</div>
	</footer>

	<script src="/js/modernizr.js"></script>
@stop