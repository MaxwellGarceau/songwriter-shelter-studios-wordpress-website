<?php get_header() ?>
<section class="page-background no__padding-top">
<!-- <div class="single-post__margin"></div> -->
<?php 

while(have_posts()) {
	the_post();

	// Custom PHP function to load page banner
	pageBanner();	
	// Main content for single
	singleMainContent([
		'related-field' => 'related_advice'
	]);
?>


<?php
	}
?>
<a href="<?php echo site_url('/songwriter-salon-music-philosophy-in-the-21st-century') ?>"><div class="single-link--box">Back to The Songwriter Salon</div></a>

</section>

<?php get_footer(); ?>