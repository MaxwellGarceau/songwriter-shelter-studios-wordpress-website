<?php

// Create Custom Post Types

function songwriter_post_types() {
	// Songwriter Salon Post Type
	register_post_type('songwriter-salon', [
		'supports' => ['title', 'editor', 'thumbnail'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Songwriter Salon Posts'
		],
		'menu_icon' => 'dashicons-lightbulb'
	]);
	// Songwriter Advice Post Type
	register_post_type('songwriter-advice', [
		'supports' => ['title', 'editor', 'thumbnail'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Songwriter Advice Posts'
		],
		'menu_icon' => 'dashicons-groups'
	]);	
	// Music Production/Composition Tutorial Post Type
	register_post_type('production-tutorials', [
		'supports' => ['title', 'editor', 'thumbnail'],
		'has_archive' => true,
		'public' => true,
		'labels' => [
			'name' => 'Music Prod & Comp Tutorials'
		],
		'menu_icon' => 'dashicons-hammer'
	]);		
}

add_action('init', 'songwriter_post_types');