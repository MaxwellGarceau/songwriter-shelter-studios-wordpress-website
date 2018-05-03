<?php get_header() ?>
<section class="page-background no__padding-top">
<!-- <div class="single-post__margin"></div> -->
<?php 

while(have_posts()) {
		the_post();

		$relatedSalonPosts = new WP_Query([
			'posts_per_page' => 2,
			'post_type' => 'songwriter-salon',
			'meta_query' => [ 
				'key' => 'related_advice',
				'compare' => 'LIKE',
				'value' => '"' . get_the_ID() . '"'
				]
		]);

	// Custom PHP function to load page banner
		pageBanner();
	// Main Content for single	
		singleMainContent([
			'related-field-query' => $relatedSalonPosts
		]);	
	}
?>
<a href="<?php echo site_url('/songwriter-advice-from-a-nashville-music-producer') ?>"><div class="single-link--box">Back to Songwriter Advice</div></a>

</section>

<?php get_footer(); ?>