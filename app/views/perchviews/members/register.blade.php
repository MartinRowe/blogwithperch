<?php include('perch/runtime.php'); ?>
@extends('perchviews/members/registerGrid')
<?php
PerchSystem::set_page('/members/register');
//echo $Settings->get('perch_members_login_page')->settingValue();
//echo $page = PerchSystem::get_page();
?>

@section('registerStuff')
		
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
	<?php 
		if (perch_member_logged_in()) {
			echo '<p>You are already logged in.</p>';			
		}else{
			echo '<h1>Register</h1>';
			perch_member_form('register.html');
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