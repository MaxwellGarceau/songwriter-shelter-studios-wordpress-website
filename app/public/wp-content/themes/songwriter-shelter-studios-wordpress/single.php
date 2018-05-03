<?php get_header() ?>
<section class="page-background no__padding-top">

<?php 

while(have_posts()) {
	the_post();

	// Custom PHP function to load page banner
	pageBanner();	
	// Main single content
	singleMainContent();
	}
?>
<a href="<?php echo site_url('/songwriter-shelter-studios-blog-pages') ?>"><div class="single-link--box">Back to Main Blog</div></a>

</section>

<?php get_footer(); ?>