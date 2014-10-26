@extends('perchviews/members/logoutGrid')
<?php 
	include('perch/runtime.php');

PerchSystem::set_page('/members/logout');
//echo $page = PerchSystem::get_page();
	perch_member_log_out(); 
	PerchUtil::redirect('/members/');

?>
