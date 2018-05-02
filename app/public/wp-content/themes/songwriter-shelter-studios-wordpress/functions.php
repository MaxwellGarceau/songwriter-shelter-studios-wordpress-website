<?php

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
			<?php } if (!is_archive()) { ?>
				<div class="meta-box">
	  			<span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php
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
	wp_enqueue_script('main-songwriter-js', get_theme_file_uri('/js/script.js'), NULL, '1.0', true);	

	// Styles

	wp_enqueue_style('normalize', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/normalize.css');		
	
	// Font Awesome (local version)
	// wp_enqueue_style('font-awesome', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/fontawesome/web-fonts-with-css/css/fontawesome.css');

	// Link to font awesome (not local version)
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');	
	wp_enqueue_style('bootstrap', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/bootstrap/css/bootstrap.css');	
	wp_enqueue_style('songwriter_main_styles', get_stylesheet_uri());	
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