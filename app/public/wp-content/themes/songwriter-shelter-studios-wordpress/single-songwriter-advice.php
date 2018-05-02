<?php get_header() ?>
<section class="page-background no__padding-top">
<!-- <div class="single-post__margin"></div> -->
<?php 

while(have_posts()) {
	the_post();

	// Custom PHP function to load page banner
	pageBanner();	
?>
<div class="main-content-well newsfeed__margin newsfeed-well__width newsfeed-well__background-color">


<div class="generic-content main-content-well newsfeed-well__width">
<?php the_content(); ?>

<br>

<?php 
	
	$relatedSalonPosts = new WP_Query([
		'posts_per_page' => 2,
		'post_type' => 'songwriter-salon',
		'meta_query' => [ 
			'key' => 'related_advice',
			'compare' => 'LIKE',
			'value' => '"' . get_the_ID() . '"'
			]
	]);

if ($relatedSalonPosts->have_posts()) {
		echo '<hr>';
		echo '<h4 class="related-post--title">If You Liked This You Might Also Like...</h4>';
		echo '<ul class="related-post--list">';
	while($relatedSalonPosts->have_posts()) {
		$relatedSalonPosts->the_post(); ?>
			<li><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title()?></a></li>			
		<?php
	}
		echo '</ul>';

}
?>


</div>
</div>
</div>

<?php
	}
?>
<a href="<?php echo site_url('/songwriter-advice-from-a-nashville-music-producer') ?>"><div class="single-link--box">Back to Songwriter Advice</div></a>

</section>

<?php get_footer(); ?>