<?php 
/*
 * Template Name: Forum Posts
 * Template Post Type: music-phil-forum, music-prod-forum, song-discuss-forum, off-topic-forum
 */
get_header(); ?>
<section class="forum-background no__padding-top">
<div style="padding-top: 80px;"></div>
<?php 
while(have_posts()) {
	the_post();

	// Add up post views
	setPostViews(get_the_id());
	
	// Custom PHP function to load page banner
	// pageBanner();
	// Main content for single
	forumSingleMainContent();
	comments_template();
	}
?>
<a href="<?php echo site_url('/songwriter-shelter-forum') ?>"><div class="single-link--box">Back to the Songwriter Shelter Forum</div></a>

</section>

<?php get_footer(); ?>