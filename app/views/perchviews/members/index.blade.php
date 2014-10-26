<?php include('perch/runtime.php'); ?>
@extends('perchviews/members/membersGrid')
<?php
PerchSystem::set_page('/members');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('membersStuff')
	
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">

		<?php 
			if (perch_member_logged_in()) {
				echo '<h1>Welcome back, '.perch_member_get('first_name').'!</h1>';
			}else{
				echo '<h1>Hello!</h1>';
				echo '<p>You are not logged in. Please login or <a href="/members/register">register</a>.</p>';
			}
		?>

		</div>
		
		<nav class="sidebar">
			<?php
				if (perch_member_logged_in()) {
			?>	
				<ul>
					<li><a href="profile">Edit profile</a></li>
					<li><a href="logout">Log out</a></li>
				</ul>

			<?php
				}else{
					perch_members_login_form();	
				}
			?>
		</nav>	
	</div>
    <?php perch_get_javascript(); ?>
@stop