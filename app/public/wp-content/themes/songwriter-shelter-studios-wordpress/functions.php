<?php

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
	// wp_enqueue_style('font-awesome', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/fontawesome/web-fonts-with-css/css/fontawesome.css');
	// Link to font awesome (not local version)
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');	
	wp_enqueue_style('bootstrap', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/bootstrap/css/bootstrap.css');	
	wp_enqueue_style('songwriter_main_styles', get_stylesheet_uri());	
}

add_action('wp_enqueue_scripts', 'songwriter_files');