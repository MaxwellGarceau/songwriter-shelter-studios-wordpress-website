				<?php
					function upvoteButton() {
				?>					                    
                    <!-- UPVOTE CONTAINER START-->
					<div class="upvote-content">

						<?php //Accesses backend database 

						// Gets amount of 'upvote posts' from wordpress database
							$upvoteCount = new WP_Query([
								'post_type' => 'upvote',
							]);

						// Checks to see if user has already clicked upvote-box
							$existStatus = 'no';

							if(is_user_logged_in()) {
								$existQuery = new WP_Query([
									'author' => get_current_user_id(),
									'post_type' => 'upvote'
								]);								
							}

							if ($existQuery->found_posts) {
								$existStatus = 'yes';
							}

						?>

					<span class="upvote-box" data-upvote="<?php echo $existQuery->posts[0]->ID; ?>" data-user="1" data-exists="<?php echo $existStatus; ?>">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<span class="upvote-count"><?php echo $upvoteCount->found_posts; ?></span>
					</span>
					</div>
					<!-- UPVOTE CONTAINER END-->
				<?php
					}
				?>					