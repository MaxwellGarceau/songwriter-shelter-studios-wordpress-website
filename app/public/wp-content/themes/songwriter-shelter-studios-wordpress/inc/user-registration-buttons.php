<?php
	function userRegButton() {
        global $wp;
?>
<!-- USER LOGIN/SIGNUP/LOGOUT START -->
				<?php if(is_user_logged_in()) { ?>
		            <span class="nav-item nav-reg__position nav-reg__left-elem nav-reg__left-elem--user-pic">
		              <span class="site-header__avatar nav-link">
						<?php echo get_avatar(get_current_user_id(), 40); ?>		
					  </span>
		            </span>									

          			<span class="nav-item nav-reg__position nav-reg__right-elem">
		              <a class="signup-link nav-link" href="<?php echo wp_logout_url(home_url($wp->request)); ?>"><button class="nav-reg__button">Log Out</button></a>
		            </span>						
						<?php
				} else { 
					?>
		            <span class="nav-item nav-reg__position nav-reg__left-elem">
		              <a class="signup-link nav-link" href="<?php echo wp_registration_url(home_url($wp->request)); ?>"><button class="nav-reg__button">Signup</button></a>
		            </span>	

          			<span class="nav-item nav-reg__position nav-reg__right-elem">
		              <a class="signup-link nav-link" href="<?php echo wp_login_url(home_url($wp->request)); ?>"><button class="nav-reg__button">Log In</button></a>
		            </span>	
						<?php
				} ?>	
<!-- USER LOGIN/SIGNUP/LOGOUT END -->
<?php
	}
?>
