<?php

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