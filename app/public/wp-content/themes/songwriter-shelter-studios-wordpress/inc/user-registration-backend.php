<?php
// USER LOGIN/SIGNUP/LOGOUT


// Redirect User Login to Front Page

function redirectSubsToFrontEnd() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}

add_action('admin_init', 'redirectSubsToFrontEnd');

// Hide admin bar for subscribers
function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}

add_action('wp_loaded', 'noSubsAdminBar');

// Customize Login Screen

function ourHeaderUrl() {
	return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'ourHeaderUrl');

function ourLoginCSS() {
	wp_enqueue_style('normalize', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/normalize.css');		
	
	// Font Awesome (local version)
	// wp_enqueue_style('font-awesome', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/fontawesome/web-fonts-with-css/css/fontawesome.css');

	// Link to font awesome (not local version)
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');	
	wp_enqueue_style('bootstrap', 'http://songwriter-shelter-studios.local/wp-content/themes/songwriter-shelter-studios-wordpress/vendor/bootstrap/css/bootstrap.css');	
	wp_enqueue_style('songwriter_main_styles', get_stylesheet_uri());
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginTitle() {
	return get_bloginfo('name');
}

add_filter('login_headertitle', 'ourLoginTitle');