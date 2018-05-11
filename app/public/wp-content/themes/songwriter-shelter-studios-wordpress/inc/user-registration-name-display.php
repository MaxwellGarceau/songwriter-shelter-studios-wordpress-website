<?php
	function userRegNameDisplay() {
?>
	<?php 
	if (is_user_logged_in()) {
		?>

          			<span class="nav-item nav-reg__position nav-reg__user-name nav-reg__user-name--mobile-display-none">
		              <span class="nav-link italic__font">Welcome, 
		              	<?php
						global $current_user;
						get_currentuserinfo();

						echo $current_user->user_login;
						 ?>!</span>
		            </span>
					<?php
						}
					?>
<?php } ?>