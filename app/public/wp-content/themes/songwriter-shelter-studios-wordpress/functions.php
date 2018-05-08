<?php

require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/user-registration-backend.php');
require get_theme_file_path('/inc/upvote.php');

// Custom Function Includes
require get_theme_file_path('/inc/upvote-button.php');
require get_theme_file_path('/inc/user-registration-buttons.php');

function songwriter_custom_rest() {
	register_rest_field('post', 'categoryName', [
		'get_callback' => function() {
			return get_post_type();
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
		if (get_field('page_banner_background_image')) {
			$args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
		} else {
			$args['photo'] = get_theme_file_uri('/images/testimonials-background.jpg');
		}
	}
	?>
	<div class="page-banner">
		<div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)">
			<?php if (is_page() OR is_archive()) {
				?> 
				<h1 class="blog-title__font <?php if (!is_archive()) { 
					echo'pagebanner-title__margin'; 
				} else { 
					echo 'pagebanner-title__margin-archive'; 
				} ?> "><?php echo $args['title']; ?></h1>
				<hr class='no__margin-bottom'>
			<?php
			} else { ?>
				<h6 class="newsfeed-post-title pagebanner-title__margin "><?php echo $args['title']; ?></h6>
				<hr>
			<?php } if (!is_archive() AND !is_page(93) AND !is_search()) { ?>
				<div class="meta-box">
	  			<span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
			</div>
			<?php } ?>
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

	<div class="generic-content forum-post__well">

	<div>
		<h6 class="forum-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
	  	<span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
	</div>
<br>
	<?php if(empty(get_the_content())) {
		echo custom_field_excerpt('main_body_content');
	} else {
		the_excerpt();
	} ?>
	<br>
	<span><a href="<?php the_permalink(); ?>">Full Post &raquo;</a></span>
	</div>
	</div>
	</div>
	<?php
	}	
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
								upvoteButton();
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
      	<br>
      <span class="metabox__main breadcrumb--title-text"><?php echo get_the_title($mainPage); ?></span></p>
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
	?>
	<div class="page-links side-list__float-left">
        <!-- Maybe link title of Side List to archive for the current post type -->
      <div class="page-links__title"><a href="<?php echo get_post_type_archive_link($args['post-type']) ?>"><?php echo $args['title'] ?></a></div>
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
	  <span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
	</div>



	<div class="generic-content main-content-well newsfeed-well__width">
	<?php if(empty(get_the_content())) {
		echo custom_field_excerpt('main_body_content');
	} else {
		the_excerpt();
	} ?>
	<br>
	<span><a href="<?php the_permalink(); ?>">Continue Reading &raquo;</a></span>
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
			<li><a href="<?php echo get_the_permalink($field); ?>"><?php echo get_the_title($field)?></a></li>
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
				<li><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title()?></a></li>			
			<?php
		}
			echo '</ul>';
	}
}

// Load styles and scripts
function songwriter_files() {
	// Scripts

	wp_enqueue_script('jquery', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/jquery/jquery.min.js', NULL, '1.0', true);	
	wp_enqueue_script('bootstrap-js', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/bootstrap/js/bootstrap.bundle.min.js', NULL, '1.0', true);	
	wp_enqueue_script('jquery-easing', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/jquery-easing/jquery.easing.min.js', NULL, '1.0', true);
	wp_enqueue_script('jquery-ui', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/jquery-ui-waypoints/jquery-ui.min.js', NULL, '1.0', true);
	wp_enqueue_script('jquery-waypoints', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/jquery-ui-waypoints/jquery.waypoints.min.js', NULL, '1.0', true);
	wp_enqueue_script('scrolling-nav', get_theme_file_uri('/js/scrolling-nav.js'), NULL, '1.0', true);	
	wp_enqueue_script('search-js', get_theme_file_uri('/js/search.js'), NULL, '1.0', true);		
	wp_enqueue_script('upvote-js', get_theme_file_uri('/js/upvote.js'), NULL, '1.0', true);
	wp_enqueue_script('forum-js', get_theme_file_uri('/js/forum.js'), NULL, '1.0', true);
	wp_enqueue_script('main-songwriter-js', get_theme_file_uri('/js/script.js'), NULL, '1.0', true);	

	// Styles

	wp_enqueue_style('normalize', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/normalize.css');		
	
	// Font Awesome (local version)
	// wp_enqueue_style('font-awesome', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/fontawesome/web-fonts-with-css/css/fontawesome.css');

	// Link to font awesome (not local version)
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');	
	wp_enqueue_style('bootstrap', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/bootstrap/css/bootstrap.css');	
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