<?php include('perch/runtime.php'); ?>
@extends('homeGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/home.blade.php');

// $page = PerchSystem::get_page();
// echo $page
?>

@section('homeContent')
<?php perch_content('homeIntro'); ?>
@stop
