<?php include('perch/runtime.php'); ?>
@extends('perchviews/members/resetGrid')
<?php
PerchSystem::set_page('/members/reset');
//echo $page = PerchSystem::get_page();
?>

@section('resetStuff')

	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
	<?php 
		if (perch_member_logged_in()) {
			echo '<p>You are already logged in.</p>';			
		}else{
			echo '<h1>Get a new password</h1>';
			perch_member_form('reset_password.html');
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