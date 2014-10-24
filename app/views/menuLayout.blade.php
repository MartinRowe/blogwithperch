@extends('menuLayoutGrid')
@section('navCSS')
<head>
    <meta charset="UTF-8">
    <title>AssessAndmprove</title>
 <!--   <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    {{HTML::style('css/style.css');}} 
 

</head>
<body>

<ul class="nav nav--fit">
   <li><a href="{{ URL::to('/') }}" class="greybox">Home</a></li>
   <li><a href="{{ URL::to('blog') }}" class="greybox">Blog</a></li>
   <li><a href="{{ URL::to('faq') }}" class="greybox">FAQ</a></li>
   <li><a href="{{ URL::to('about') }}" class="greybox">About</a></li>

<!--   <li><a href="{{ URL::to('search') }}" class="greybox">Search</a></li> -->
<!--   <li><a href="{{ URL::to('listdetail') }}" class="greybox">ListDetail</a></li>
   <li><a href="{{ URL::to('blogg') }}" class="greybox">Blogg</a></li> -->
</ul>

<br />
<hr />
@stop

@section('searchSection')
	
<?php
    $query = perch_get('q');
    perch_content_search($query, array(
        'count'=>5,
        'template'=>'my-search-form.html'
      ));
?>
		
		<nav class="sidebar">
		   <?php perch_search_form(); ?>
    	</nav>
	
    <?php perch_get_javascript(); ?>
@stop

@section('myFooter')
<footer class="layout-footer">
		<div class="wrapper">
		
			<small>Copyright &copy; <?php echo date('Y'); ?></small>
		</div>
</footer>
@stop
