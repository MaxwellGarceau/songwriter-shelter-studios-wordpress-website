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
		'pageSection' => [],
		'songwriterSalon' => [],
		'songwriterAdvice' => [],
		'productionTutorials' => []
	];

	while($mainQuery->have_posts()) {
		$mainQuery->the_post();		

		if (get_post_type() == 'post' OR get_post_type() == 'page') {
			array_push($results['pageSection'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'postDate' => get_the_date('M, Y'),
				'id' => get_the_id()
			]);
		}
		if (get_post_type() == 'songwriter-salon') {
			$relatedSongwriterAdvice = get_field('related_advice');

			if ($relatedSongwriterAdvice) {
				foreach($relatedSongwriterAdvice as $advice) {
					array_push($results['songwriterAdvice'], [
						'title' => get_the_title($advice),
						'permalink' => get_the_permalink($advice),
						'postType' => get_post_type($advice),
						'postDate' => get_the_date('M, Y', $advice),
						'id' => get_the_id($advice)
					]);
				}
			}

			// $relatedProductionTutorial = get_field('related_to_production_tutorials');

			// if ($relatedProductionTutorial) {
			// 	foreach($relatedProductionTutorial as $tutorial) {
			// 		array_push($results['songwriterAdvice'], [
			// 			'title' => get_the_title($tutorial),
			// 			'permalink' => get_the_permalink($tutorial),
			// 			'postType' => get_post_type($tutorial),
			// 			'postDate' => get_the_date('M, Y', $tutorial),
			// 			'id' => get_the_id($tutorial)
			// 		]);
			// 	}
			// }				
		

			array_push($results['songwriterSalon'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'postDate' => get_the_date('M, Y'),
				'id' => get_the_id()
			]);
		}	
		if (get_post_type() == 'songwriter-advice') {
			array_push($results['songwriterAdvice'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'postDate' => get_the_date('M, Y'),
				'id' => get_the_id()
			]);
		}	
		if (get_post_type() == 'production-tutorials') {
			array_push($results['productionTutorials'], [
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'postType' => get_post_type(),
				'postDate' => get_the_date('M, Y'),
				'id' => get_the_id()
			]);
		}						
	}

// related to songwriter advice from songwriter salon
	if ($results['songwriterAdvice']) {
		$relatedMetaQuery = ['relation' => 'OR'];

		foreach($results['songwriterAdvice'] as $item) {
			array_push($relatedMetaQuery, [
					'key' => 'related_advice',
					'compare' => 'LIKE',
					'value' => '"' . $item['id'] . '"'
				]);
		}

		$relatedQuery = new WP_Query([
			'post_type' => 'songwriter-salon',
			'meta_query' => $relatedMetaQuery
			]);

		while ($relatedQuery->have_posts()) {
			$relatedQuery->the_post();

			if (get_post_type() == 'songwriter-salon') {
				array_push($results['songwriterSalon'], [
					'title' => get_the_title(),
					'permalink' => get_the_permalink(),
					'postType' => get_post_type(),
					'postDate' => get_the_date('M, Y'),
					'id' => get_the_id()
				]);
			}

		}
		$results['songwriterAdvice'] = array_values(array_unique($results['songwriterAdvice'], SORT_REGULAR));
	}

// Related to songwriter salon from music production
	if ($results['songwriterSalon']) {
		$relatedMetaQuery = ['relation' => 'OR'];

		foreach($results['songwriterSalon'] as $item) {
			array_push($relatedMetaQuery, [
					'key' => 'related_to_songwriter_salon',
					'compare' => 'LIKE',
					'value' => '"' . $item['id'] . '"'
				]);
		}

		$relatedQuery = new WP_Query([
			'post_type' => 'production-tutorials',
			'meta_query' => $relatedMetaQuery
			]);

		while ($relatedQuery->have_posts()) {
			$relatedQuery->the_post();

			if (get_post_type() == 'production-tutorials') {
				array_push($results['productionTutorials'], [
					'title' => get_the_title(),
					'permalink' => get_the_permalink(),
					'postType' => get_post_type(),
					'postDate' => get_the_date('M, Y'),
					'id' => get_the_id()
				]);
			}

		}
		$results['productionTutorials'] = array_values(array_unique($results['productionTutorials'], SORT_REGULAR));
	}	

	return $results;
}

add_action('rest_api_init', 'songwriterRegisterSearch');