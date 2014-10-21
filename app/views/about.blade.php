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