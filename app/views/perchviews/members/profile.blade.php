<?php include('perch/runtime.php'); ?>
@extends('perchviews/members/profileGrid')
<?php
PerchSystem::set_page('/members/profile');
//echo $page = PerchSystem::get_page();
?>

@section('profileStuff')
	
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">

		<?php 
			if (perch_member_logged_in()) {
 				echo '<h1>Hi, '.perch_member_get('first_name').'! This is your profile</h1>';
				perch_member_form('profile.html');

				echo '<h2>Update your password</h2>';
				perch_member_form('password.html');
			}else{
				echo '<a href="/members/">Please log in</a>';
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