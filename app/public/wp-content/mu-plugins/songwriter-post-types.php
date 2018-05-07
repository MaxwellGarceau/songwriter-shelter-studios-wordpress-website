<?php

// Create Custom Post Types

function songwriter_post_types() {
	// Songwriter Salon Post Type
	register_post_type('songwriter-salon', [
		'show_in_rest' => true,
		'supports' => ['title', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Songwriter Salon Posts'
		],
		'menu_icon' => 'dashicons-lightbulb'
	]);
	// Songwriter Advice Post Type
	register_post_type('songwriter-advice', [
		'show_in_rest' => true,
		'supports' => ['title', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Songwriter Advice Posts'
		],
		'menu_icon' => 'dashicons-groups'
	]);	
	// Music Production/Composition Tutorial Post Type
	register_post_type('production-tutorials', [
		'show_in_rest' => true,
		'supports' => ['title', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Music Prod & Comp Tutorials'
		],
		'menu_icon' => 'dashicons-hammer'
	]);			

	// Forum Pages

	// Main Forum Landing Page
	register_post_type('forum', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => false,
		'public' => true,
		'labels' => [
			'name' => 'Forum'
		],
		'menu_icon' => 'dashicons-groups'
	]);	

	// Music Philosophy Discussions
	register_post_type('music-phil-forum', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Music Philosophy Forum'
		],
		'menu_icon' => 'dashicons-schedule'
	]);		

	// Music Production Discussions
	register_post_type('music-prod-forum', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Music Production Forum'
		],
		'menu_icon' => 'dashicons-flag'
	]);		

	// Music Production Discussions
	register_post_type('song-discuss-forum', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Songwriting Discussion Forum'
		],
		'menu_icon' => 'dashicons-art'
	]);		

	// Off Topic Discussions
	register_post_type('off-topic-forum', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Off Topic Forum'
		],
		'menu_icon' => 'dashicons-id'
	]);			

	// Utility Posts (Such as contact form, music player, etc)
	register_post_type('utility', [
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'has_archive' => false,
		'public' => true,
		'labels' => [
			'name' => 'Utility Widgets'
		],
		'menu_icon' => 'dashicons-hidden'
	]);					

	// Upvote Post Type
	register_post_type('upvote', [
		'supports' => ['title'],
		'public' => false,
		'show_ui' => true,
		'labels' => [
			'name' => 'Upvotes',
			'add_new_item' => 'Add New Upvote',
			'edit_item' => 'Edit Upvote',
			'all_items' => 'All Upvotes',
			'singular_name' => 'Upvote'
		],
		'menu_icon' => 'dashicons-arrow-up-alt'
	]);
}

add_action('init', 'songwriter_post_types');

/**
 * Hide editor on specific pages.
 *
 */

function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  // Hide the editor on the page titled 'Homepage'
  $homepgname = get_the_title($post_id);
  if($homepgname == 'Homepage'){ 
    remove_post_type_support('page', 'editor');
  }
  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  if($template_file == 'my-page-template.php'){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}

add_action( 'admin_init', 'hide_editor' );