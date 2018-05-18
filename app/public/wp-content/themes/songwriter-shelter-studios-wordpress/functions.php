<?php

require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/user-registration-backend.php');
require get_theme_file_path('/inc/upvote.php');

// Custom Function Includes
require get_theme_file_path('/inc/upvote-button.php');
require get_theme_file_path('/inc/user-registration-buttons.php');
require get_theme_file_path('/inc/user-registration-name-display.php');

function songwriter_custom_rest() {
	register_rest_field('post', 'categoryName', [
		'get_callback' => function() {
			return get_post_type();
		}
	]);
	// User count rest info for forums
	register_rest_field('music-phil-forum', 'userPostCount', [
		'get_callback' => function() {
			return count_user_posts(get_current_user_id(), 'music-phil-forum');
		}
	]);	
	register_rest_field('music-prod-forum', 'userPostCount', [
		'get_callback' => function() {
			return count_user_posts(get_current_user_id(), 'music-prod-forum');
		}
	]);	
	register_rest_field('song-discuss-forum', 'userPostCount', [
		'get_callback' => function() {
			return count_user_posts(get_current_user_id(), 'song-discuss-forum');
		}
	]);	
	register_rest_field('off-topic-forum', 'userPostCount', [
		'get_callback' => function() {
			return count_user_posts(get_current_user_id(), 'off-topic-forum');
		}
	]);				
}

add_action('rest_api_init', 'songwriter_custom_rest');

// Custom Functions

// Generic (all pages or several different ones)

// Custom Excerpt function for Advanced Custom Fields
function custom_field_excerpt($fieldName, $wordCount = 55) {
	global $post;
	$text = get_field($fieldName);
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]&gt;', ']]&gt;', $text);
		$excerpt_length = $wordCount;
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}

// Function for page banner on blog
function pageBanner($args = []) {
	// php logic
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['subtitle']) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	}
	if (!$args['photo']) {
		// if (get_field('page_banner_background_image')) {
		// 	$args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
		// } else {
			$args['photo'] = get_theme_file_uri('/images/autumn-background-board-min-crop.jpg');
		// }
	}
	?>
	<div class="page-banner">
		<div class="flex-box-vertical__parent page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)">
			<div class="page-banner__flex-child">
			<?php if (is_page() OR is_archive()) {
				?> 
				<h1 class="blog-title__font <?php if (!is_archive()) { 
					echo'pagebanner-title__margin'; 
				} else { 
					echo 'pagebanner-title__margin-archive'; 
				} ?> "><?php echo $args['title']; ?></h1>
				<hr class='no__margin-bottom' style="padding-bottom: 5px;">
			<?php
			} else { ?>
				<h6 class="page-single__title single-title__margin pagebanner__title--width"><?php echo $args['title']; ?></h6>
				<hr>
			<?php } if (!is_archive() AND !is_page(93) AND !is_page(246) AND !is_search() AND !is_single()) { ?>
				<!-- <div class="meta-box"> -->
	  			<span class="italic__font">Last post on <?php the_time('F, Y'); ?></span>
			<!-- </div> -->
			<?php } if (is_single()) {
				?>
				<div class="italic__font"><span>Posted by <?php the_author_posts_link(); ?> in <?php the_time('F, Y'); ?></span></div>
				<?php
			} ?>
		</div>
		</div>
	</div>
	<?php
}

// Forums

// Forum Main Content
function forumMainContent($args = []) {
	if (!$args['query']) {
		$args['query'] = $defaultQuery;
	}
	?>
	<!-- Main Content -->
	    <div class="page--posts">
	    <?php 

	      while($args['query']->have_posts()) {
	    $args['query']->the_post(); ?>
	<!-- Post Body -->
	<div class="forum-post newsfeed-well__background-color">

<!-- Forum Post Type Pic -->
<div class="forum-post__icons-container forum-post__icons-container forum-post__icons-container--category-pic">
	<span class="forum-post__icons"><i class="fa <?php echo forumCategoryPic(); ?> forum-post__icons--category"></i></span>
	<br>
	<span class="forum-post__icons--subtitle"><?php echo forumCategorySubtitle(); ?></span>
</div>

<!-- Comments pic -->
<div class="forum-post__icons-container forum-post__icons-container forum-post__icons-container--comments">
	<span class="forum-post__icons">
	<?php 
	if (get_comments_number() == 0) { ?> 
		<a href="<?php the_permalink(); ?>"><?php comments_number('Be the first to comment!', '1', '%') ?></a> <?php 
	} else {
		comments_number('Be the first to comment!', '1', '%');
	} ?>
	 &nbsp;&nbsp;<i class="fa fa-comments forum-post__icons--comments"></i>
	</span>
</div>

<!-- View Count Per Post -->
<div class="forum-post__icons-container forum-post__icons-container forum-post__icons-container--views">
	<span class="forum-post__icons">
		<?php if (get_post_meta(get_the_ID(), 'post_views_count', true) != 0) {
			echo get_post_meta(get_the_ID(), 'post_views_count', true);
		} else {
			echo '0';
		} ?>&nbsp;&nbsp;<i class="fa fa-eye forum-post__icons--views"></i>
	</span>
</div>	

	<div class="generic-content forum-post__well">

	<div>
		<h6 class="forum-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
	  	<span class="forum-post__author">Posted by <?php the_author_posts_link(); ?> in <?php the_time('F, Y'); ?></span>
	</div>
<br>
<div class="forum-post__content">
	<?php if(empty(get_the_content())) {
		echo custom_field_excerpt('main_body_content');
	} else {
		the_excerpt();
	} ?>
</div>
<!-- 	<br>
	<div class="forum-post__full-post"><a href="<?php the_permalink(); ?>">Full Post &raquo;</a></div> -->
	</div>
	</div>
	<?php
	}	
	?>	
	</div>
<?php
}

// Switch Statement for forum post type category pic
function forumCategoryPic() {
	switch(get_post_type()) {
		case 'music-phil-forum':
		return 'fa-book';
		case 'song-discuss-forum':
		return 'fa-music';
		case 'music-prod-forum':
		return 'fa-headphones';
		case 'off-topic-forum':
		return 'fa-paper-plane';
	}
}

// Subtitle for forum post type category pic
function forumCategorySubtitle($postType = null) {
	if (!$postType) {
		$postType = get_post_type();
	}
	switch($postType) {
		case 'music-phil-forum':
		return 'Music Philosophy';
		case 'song-discuss-forum':
		return 'Songwriting';
		case 'music-prod-forum':
		return 'Music Production';
		case 'off-topic-forum':
		return 'Off Topic';
	}
}

// Forum create, edit, delete buttons

function forumPostCreateDeleteModifyButtons($postTypeQuery) {
	// $postTypeQuery->the_post();
	$postType = $postTypeQuery->query['post_type'];
	?>
          <!-- Forum Button Start -->
          <!-- needs argument for 1) query type for while loop 2) post type for ajax request  -->
          <i class="forum-button__caption">Manage your <?php echo forumCategorySubtitle($postType); ?> posts</i>
          <br>
            <button class="user-posts-button forum-button user-posts-button__show" id="user-posts-button">Show My Posts</button>
            <div class="user-posts user-posts-area__show" id="user-posts-area">
                <?php if (is_user_logged_in()) { 
                		if (count_user_posts(get_current_user_id(), $postType) == 0) {
                			?> 
							<div class="forum-button__no-posts">You don't have any posts at the moment. Click the "Create A Post" button to make some!</div>
                			<?php
                		}
                	?>
                <ul class="user-posts__list user-forum-posts" id="user-forum-posts">
                    <?php while($postTypeQuery->have_posts()) {
    $postTypeQuery->the_post();
    ?>
                    <!-- User Posts -->
                    <li data-id="<?php the_ID(); ?>" data-post-type="<?php echo get_post_type(); ?>">
                        <input readonly class="user-posts__title" value="<?php echo esc_attr(get_the_title()); ?>">
                        <br>
                        <textarea readonly class="user-posts__content"><?php echo esc_attr(get_the_content()); ?></textarea>
                        <br>
                        <span class="edit-forum-post"><i class="fa fa-pencil" aria-hidden="true"> Edit</i></span>
                        <span class="delete-forum-post"><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></span>
                        <span class="update-forum-post"><i class="fa fa-arrow-right" aria-hidden="true"> Save</i></span>
                        <hr class="user-posts__hr">
                    </li>
                    <?php
  } ?>
                </ul>
                <?php } else {
    echo '<p>Please log in to see your posts.</p>';
  } ?>
            </div>
            <button class="user-posts-button forum-button user-posts-button__create" id="user-create-posts-button">Create A Post</button>
            <div data-post-type="<?php echo $postType; ?>" class="user-create-posts user-posts-area__create" id="user-create-posts-area">
                <h4>Make a Post</h4>

                    <input placeholder="Title" class="new-forum-post-title">
                    <hr class="forum-post-title__hr">
                    <textarea placeholder="Your post here..." class="new-forum-post-body-field"></textarea>
                    <span class="create-forum-post">Create Post</span>
                    <br>
                    <span class="forum-post-limit-message">Daily Post Limit Reached. Don't worry, you can post tomorrow.</span>
            </div>  
            <!-- Forum Button End -->  	
            <?php
}

// Main Content for forum singles
function forumSingleMainContent($args = []) {
	if (!$args['related-field-query']) {
		$args['related-field-query'] = NULL;
	}
	if (!$args['related-post-destination-title']) {
		$args['related-post-destination-title'] = 'If You Liked This You Might Also Like...';
	}
	if (!$args['related-post-origin-title']) {
		$args['related-post-origin-title'] = 'Related Posts';
	}	
	if (!$args['related-field']) {
		$args['related-field'] = NULL;
	}

?>
	<div class="main-content-well newsfeed__margin newsfeed-well__width newsfeed-well__background-color">

		<h2 class="forum-single__title">
			<?php the_title(); ?>
		</h2>

	<?php if (has_post_thumbnail()) { ?>

			<div class="generic-content main-content-well newsfeed-well__width container forum-single__well">
				<div class="row">
					<div class="row">
						<div class="col-sm-4">
							<img class="featured-thumbnail-image-custom" src="<?php the_post_thumbnail_url('featured-blogimg-size'); ?>">
							<p class="italic__font smaller-font darker-color"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
						</div>
						<div class="col-sm-8">
							<?php 
								if(empty(get_the_content())) {
									echo get_field('main_body_content');
								} else {
									the_content();
								} 
								if ($args['related-field']) {
									singleRelatedPost($args['related-field'], $args['related-post-origin-title']);
								}
								if ($args['related-field-query']) {
									singleRelatedPostLinkBack($args['related-field-query'], $args['related-post-destination-title']);
								}
								upvoteButton();
							?>
						</div>
					</div>
				</div>
				<br>
			</div>	


					
		<?php } else { ?>
			<div class="generic-content main-content-well newsfeed-well__width forum-single__well">		
			<?php 
				if(empty(get_the_content())) {
					echo get_field('main_body_content');
				} else {
					the_content();
				}
				if ($args['related-field']) {
					singleRelatedPost($args['related-field'], $args['related-post-origin-title']);
				}
				if ($args['related-field-query']) {
					singleRelatedPostLinkBack($args['related-field-query'], $args['related-post-destination-title']);
				}
				upvoteButton();
			?>
			<br>
			</div>
			<?php } ?>
	</div>
<?php
}

// Archives

// Archive return to main page
function archiveReturnToMainPage($mainPage = 44) {
	?>
	<div class="breadcrumb-container">
<?php 
$theParent = wp_get_post_parent_id(get_the_ID());
    ?>
      <div class="metabox">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($mainPage); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($mainPage); ?></a> 
  	  </p>
    </div>
</div>
<?php
}

// Pages

// Archive list breadcrumb of blog posts (left side)
function pageArchiveBreadCrumb($args = []) {
	$defaultQuery = new WP_Query;
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['post-type']) {
		$args['post-type'] = get_post_type();
	}
	if (!$args['query']) {
		$args['query'] = $defaultQuery;
	}
	if (!$args['float-right']) {
		$args['float-right'] = '';
	} else {
		$args['float-right'] = 'side-list__float-right';
	}
	?>
	<div class="page-links side-list__float-left <?php echo $args['float-right']; ?>">
        <!-- Maybe link title of Side List to archive for the current post type -->
      <div class="page-links__title page-links__main-background"><a href="<?php echo get_post_type_archive_link($args['post-type']) ?>"><?php echo $args['title'] ?></a></div>
      <ul class="min-list">
        <?php
        while ($args['query']->have_posts()) {
          $args['query']->the_post();
          ?>

        <li>
          <a href="<?php echo the_permalink(); ?>">            
            <?php
            echo the_title();
            ?> 
          </a>          
        </li>

        <?php
         }
          ?>
      </ul>
    </div>
    <?php
}

// Archive list breadcrumb of blog posts (left side)
function forumPostMasterList($args = []) {
	$defaultQuery = new WP_Query;
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['post-type']) {
		$args['post-type'] = get_post_type();
	}
	if (!$args['query']) {
		$args['query'] = $defaultQuery;
	}
	if (!$args['float-right']) {
		$args['float-right'] = '';
	} else {
		$args['float-right'] = 'side-list__float-right';
	}
	?>
	<div class="page-links side-list__float-left <?php echo $args['float-right']; ?> forum-breadcrumb__subsection">
        <!-- Maybe link title of Side List to archive for the current post type -->
      <div class="page-links__title page-links__main-background page-links__title--forum"><?php echo forumCategorySubtitle($args['query']->query['post_type']) . ' Posts'; ?></div>
      <ul class="min-list">
        <?php
        while ($args['query']->have_posts()) {
          $args['query']->the_post();
          ?>

        <li>
          <a href="<?php echo the_permalink(); ?>">            
            <?php
            echo the_title();
            ?> 
          </a>          
        </li>

        <?php
         }
          ?>
      </ul>
    </div>
    <?php
}

// Main Content for Blog Pages
function pageMainContent($args = []) {
	if (!$args['query']) {
		$args['query'] = $defaultQuery;
	}
	?>
	<!-- Main Content -->
	    <div class="page--posts">
	    <?php 

	      while($args['query']->have_posts()) {
	    $args['query']->the_post(); ?>
	<!-- Post Body -->
	<div class="main-content-well newsfeed__margin newsfeed-well__background-color">
	<h6 class="newsfeed-post-title"><?php the_title(); ?></h6>

	<div class="meta-box">
	  <span>Posted by <?php the_author_posts_link(); ?> in <?php the_time('F, Y'); ?></span>
	</div>



	<div class="generic-content main-content-well newsfeed-well__width">
	<?php if(empty(get_the_content())) {
		echo custom_field_excerpt('main_body_content');
	} else {
		the_excerpt();
	} ?>
	<br>
	<span><a class="inverse-link-color" href="<?php the_permalink(); ?>">Continue Reading &raquo;</a></span>
	</div>
	</div>
	</div>
	<?php
	}
}

// Single

// Main Content for singles
function singleMainContent($args = []) {
	if (!$args['related-field-query']) {
		$args['related-field-query'] = NULL;
	}
	if (!$args['related-post-destination-title']) {
		$args['related-post-destination-title'] = 'If You Liked This You Might Also Like...';
	}
	if (!$args['related-post-origin-title']) {
		$args['related-post-origin-title'] = 'Related Posts';
	}	
	if (!$args['related-field']) {
		$args['related-field'] = NULL;
	}

?>
	<div class="main-content-well newsfeed__margin newsfeed-well__width newsfeed-well__background-color">
		<h4 class="pagebanner__title--width"><?php the_title(); ?></h4>
		<hr class="no__margin-bottom no__padding">
		<?php if (has_post_thumbnail()) { ?>
			<div class="generic-content main-content-well newsfeed-well__width container">
				<div class="row">
					<div class="row">
						<div class="col-sm-4">
							<img class="featured-thumbnail-image-custom" src="<?php the_post_thumbnail_url('featured-blogimg-size'); ?>">
							<p class="italic__font smaller-font darker-color"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
						</div>
						<div class="col-sm-8">
							<?php 
								if(empty(get_the_content())) {
									echo get_field('main_body_content');
								} else {
									the_content();
								} 
								if ($args['related-field']) {
									singleRelatedPost($args['related-field'], $args['related-post-origin-title']);
								}
								if ($args['related-field-query']) {
									singleRelatedPostLinkBack($args['related-field-query'], $args['related-post-destination-title']);
								}
							?>
						</div>
					</div>
				</div>
				<br>
			</div>			
		<?php } else { ?>
			<div class="generic-content main-content-well newsfeed-well__width">		
			<?php 
				if(empty(get_the_content())) {
					echo get_field('main_body_content');
				} else {
					the_content();
				}
				if ($args['related-field']) {
					singleRelatedPost($args['related-field'], $args['related-post-origin-title']);
				}
				if ($args['related-field-query']) {
					singleRelatedPostLinkBack($args['related-field-query'], $args['related-post-destination-title']);
				}
			?>
			<br>
			</div>
			<?php } ?>
	</div>
<?php
}

// Related Posts (Origin)
function singleRelatedPost($argField, $title) {
	$relatedField = get_field($argField);
	
	if ($relatedField) {
		echo '<hr>';
		echo '<h4 class="related-post--title">' . $title . '</h4>';
		echo '<ul class="related-post--list">';
		foreach($relatedField as $field) { ?>
			<li><a class="inverse-link-color" href="<?php echo get_the_permalink($field); ?>"><?php echo get_the_title($field)?></a></li>
	<?php }
		echo '</ul>';
	}
}

// Related Posts (Destination)
function singleRelatedPostLinkBack($query, $title) {
	if ($query->have_posts()) {
			echo '<hr>';
			echo '<h4 class="related-post--title">' . $title . '</h4>';
			echo '<ul class="related-post--list">';
		while($query->have_posts()) {
			$query->the_post(); ?>
				<li><a class="inverse-link-color" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title()?></a></li>			
			<?php
		}
			echo '</ul>';
	}
}

// Add up number of views per post
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Load styles and scripts
function songwriter_files() {
	// Scripts

	wp_enqueue_script('jquery', get_theme_file_uri('/vendor/jquery/jquery.min.js'), NULL, '1.0', true);	
	wp_enqueue_script('bootstrap-js', get_theme_file_uri('/vendor/bootstrap/js/bootstrap.bundle.min.js'), NULL, '1.0', true);	
	wp_enqueue_script('jquery-easing', get_theme_file_uri('/vendor/jquery-easing/jquery.easing.min.js'), NULL, '1.0', true);
	wp_enqueue_script('jquery-ui', get_theme_file_uri('/vendor/jquery-ui-waypoints/jquery-ui.min.js'), NULL, '1.0', true);
	wp_enqueue_script('jquery-waypoints', get_theme_file_uri('/vendor/jquery-ui-waypoints/jquery.waypoints.min.js'), NULL, '1.0', true);
	wp_enqueue_script('scrolling-nav', get_theme_file_uri('/js/scrolling-nav.js'), NULL, '1.0', true);	
	wp_enqueue_script('search-js', get_theme_file_uri('/js/search.js'), NULL, '1.0', true);		
	wp_enqueue_script('upvote-js', get_theme_file_uri('/js/upvote.js'), NULL, '1.0', true);
	wp_enqueue_script('forum-js', get_theme_file_uri('/js/forum.js'), NULL, '1.0', true);
	wp_enqueue_script('main-songwriter-js', get_theme_file_uri('/js/script.js'), NULL, '1.0', true);	

	// Styles

	wp_enqueue_style('normalize', get_theme_file_uri('/vendor/normalize.css'));		
	
	// Font Awesome (local version)
	// wp_enqueue_style('font-awesome', get_theme_file_uri('/vendor/fontawesome/web-fonts-with-css/css/fontawesome.css'));

	// Link to font awesome (not local version)
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');	
	wp_enqueue_style('bootstrap', get_theme_file_uri('/vendor/bootstrap/css/bootstrap.css'));	
	wp_enqueue_style('songwriter_main_styles', get_stylesheet_uri());

	// Localize script for JSON
	wp_localize_script('search-js', 'songwriterSearch', [
		'root_url' => get_site_url()
	]);	
	wp_localize_script('main-songwriter-js', 'songwriterData', [
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	]);	
	// wp_localize_script('upvote-js', 'songwriterData', array(
	//     'root_url' => get_site_url(),
	//     'nonce' => wp_create_nonce('wp_rest')
	// ));	
}

add_action('wp_enqueue_scripts', 'songwriter_files');

// Gives WordPress control over title tag and customizes title per page
function songwriter_title() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	// Generate custom sizes for images when uploading into wordpress. Saves bandwidth of user/makes site load faster
	add_image_size('featured-blogimg-size', 300, 9999, false);
	add_image_size('page-banner', 1500, 350, true);
}

add_action('after_setup_theme', 'songwriter_title');

// // Custom single template for forum singles

// function forumSingleTemplate($template) {

//   $cpt = [ 'america', 'nepal', 'norway' ];

//   return in_array( get_queried_object()->post_type, $cpt, true )
//     ? 'path/to/country-single.php'
//     : $template;

// } 

// add_filter( 'single_template', 'forumSingleTemplate');

// Change default URL Queries

function songwriter_adjust_queries($query) {
	// Custom URL Query for Music Production & Composition Tutorials Archive
	if (!is_admin() AND is_post_type_archive('production-tutorials') AND $query->is_main_query()) {
		$query->set('posts_per_page', '-1');
	}
	// Custom URL Query for Music Production & Composition Tutorials Archive	
	if (!is_admin() AND is_post_type_archive('songwriter-salon') AND $query->is_main_query()) {
		$query->set('posts_per_page', '-1');
	}
	// Custom URL Query for Music Production & Composition Tutorials Archive
	if (!is_admin() AND is_post_type_archive('songwriter-advice') AND $query->is_main_query()) {
		$query->set('posts_per_page', '-1');
	}		
}

add_action('pre_get_posts', 'songwriter_adjust_queries');

function sanitizeForumPosts($data, $postArr) {
	$postType = $data['post_type'];
	if ($postType == 'music-phil-forum' OR $postType == 'music-prod-forum' OR $postType == 'song-discuss-forum' OR $postType == 'off-topic-forum') {
	// PUT DAILY POSTING LIMIT LOGIC FOR USERS HERE

		// Gives a hard post limit for all time periods (NOT WHAT WE WANT)
		// if (count_user_posts(get_current_user_id(), 'music-phil-forum') >= 5 AND !$postArr['ID']) {
		// 	die("Slow down, you're posting too quickly.");
		// }

		$data['post_content'] = sanitize_textarea_field($data['post_content']);
		$data['post_title'] = sanitize_text_field($data['post_title']);
	}
	return $data;
}

add_filter('wp_insert_post_data', 'sanitizeForumPosts', 10, 2);

// // Changes default login redirect
// function redirect_previous_page( $redirect_to ){
//     global $user;

//     $request = $_SERVER["HTTP_REFERER"];

//     if ( in_array( $user->roles[0], array( 'administrator') ) ) {

//         return admin_url();

//     } elseif ( in_array( $user->roles[0], array( 'subscriber') ) ) {

//         // return site_url('/songwriter-shelter-forum/');
//         return $request;
//     } 

//     return $redirect_to;
// }

// add_filter('login_redirect', 'redirect_previous_page', 10, 1);


// // Display custom post types in author archive
// function post_types_author_archives($query) {
// 	    if ($query->is_author) {
// 	            // Add 'books' CPT and the default 'posts' to display in author's archive
// 	            $query->set( 'post_type', ['songwriter-salon', 'songwriter-advice', 'production-tutorials', 'Post']);
// 	    	// $query->set( 'post_type', ['music-phil-forum']);
// 	    remove_action( 'pre_get_posts', 'custom_post_author_archive' );    	
// 	}
// }

// add_action('pre_get_posts', 'post_types_author_archives');
    