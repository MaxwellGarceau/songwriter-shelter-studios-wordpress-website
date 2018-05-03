<?php get_header() ?>
<section class="page-background no__padding-top">

<?php 
while(have_posts()) {
	the_post();

	// Custom PHP function to load page banner
	pageBanner();
	// Main content for single
	singleMainContent();
	}
?>
<a href="<?php echo site_url('/modern-music-production-and-composition-a-deep-dive-into-the-why-and-the-how') ?>"><div class="single-link--box">Back to Modern Music Production and Composition</div></a>

</section>

<?php get_footer(); ?>