<?php

function songwriterRegisterSearch() {
	register_rest_route('songwriter/v1', 'search', [
		'methods' => WP_REST_SERVER::READABLE,
		'callback' => 'songwriterSearchResults'
	]);
}

function songwriterSearchResults($data) {
	$mainQuery = new WP_Query([
		'post_type' => ['post', 'page', 'songwriter-salon', 'songwriter-advice', 'production-tutorials'],
		's' => sanitize_text_field($data['term'])
	]);

	$results = [
		'generalInfo' => [],
		'songwriter-salon' => [],
		'songwriter-advice' => [],
		'production-tutorials' => []
	];

	while($mainQuery->have_posts()) {
		$mainQuery->the_post();		

		if (get_post_type() == 'post' OR get_post_type() == 'page') {
			array_push($results['generalInfo'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			]);
		}
		if (get_post_type() == 'songwriter-salon') {
			array_push($results['songwriter-salon'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			]);
		}	
		if (get_post_type() == 'songwriter-advice') {
			array_push($results['songwriter-advice'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			]);
		}	
		if (get_post_type() == 'production-tutorials') {
			array_push($results['production-tutorials'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink()
			]);
		}						
	}

	return $results;
}

add_action('rest_api_init', 'songwriterRegisterSearch');