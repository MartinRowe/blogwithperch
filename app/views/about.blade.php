<?php include('perch/runtime.php'); ?>
@extends('aboutGrid')




<?php
	PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/about.blade.php');
	// $page = PerchSystem::get_page();
	// echo $page
?>


@section('aboutContent')
	<p>About</p>
	<?php perch_content('AboutIntro'); ?>
@stop


@section('myNavStacked')
 <ul class="nav  nav--stacked">
       <li><a href=#>Home</a></li>
       <li><a href=#>About</a></li>
       <li><a href=#>Portfolio</a></li>
       <li><a href=#>Contact</a></li>
   </ul>
@stop

<!--
<div class=flyout>
       Foo
       <div class=flyout__content>
           <h1>Lorem</h1>
           <p>Ipsum</p>
       </div>
   </div>

   <div class=media>
       <img src= meSmile.jpg/100/100 alt="" class=media__img>
       <p class=media__body>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
       sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
   </div>


    <ul class="matrix  three-cols">
       <li class=all-cols>Lorem</li>
       <li>Ipsum <a href=#>dolor</a></li>
       <li><a href=# class=matrix__link>Sit</a></li>
       <li>Amet</li>
       <li class=all-cols>Consectetuer</li>
   </ul>
   
   -->

