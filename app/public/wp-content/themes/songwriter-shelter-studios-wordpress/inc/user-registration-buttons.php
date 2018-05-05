<?php
	function userRegistrationButtons() {
?>
<!-- USER LOGIN/SIGNUP/LOGOUT START -->
<div class="login-master-container">
<div class="login-text">
	<?php 
	if (is_user_logged_in()) {
		?>


					<span>
						Welcome, 
					</span>
					<span>
						<br> 
						<?php
						global $current_user;
						get_currentuserinfo();

						echo $current_user->user_login;
						 ?>!
						</span>	
					<?php
						}
					?>
</div>

<div class="login-button">
				<?php if(is_user_logged_in()) {
					?>
					<span class="site-header__avatar">
						<?php echo get_avatar(get_current_user_id(), 40); ?>		
					</span>					

					<br>
					<a class="signup-link" href="<?php echo wp_logout_url(); ?>"><button class="user-login">Log Out</button>	
						
					</a>
						<?php
				} else { 
					?>
					<a class="signup-link" href="<?php echo wp_registration_url(); ?>"><button class="user-signup">Signup</button></a>
					<a class="signup-link" href="<?php echo wp_login_url(); ?>"><button class="user-login">Log In</button></a>
						<?php
				} ?>
</div>							
</div>
<!-- USER LOGIN/SIGNUP/LOGOUT END -->
<?php
	}
?>
