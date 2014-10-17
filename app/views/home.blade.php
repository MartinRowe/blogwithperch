<?php include('perch/runtime.php'); ?>
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/home.blade.php');
// Try this to get me out of a bind
// $page = PerchSystem::get_page();
// echo $page
?>
@extends('homeGrid')

@section('homeContent')
<?php perch_content('homeIntro'); ?>
@stop
