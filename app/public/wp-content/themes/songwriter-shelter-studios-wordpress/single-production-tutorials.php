<?php get_header() ?>
<section class="page-background no__padding-top">

<?php 
while(have_posts()) {
	the_post();

	// Custom PHP function to load page banner
	pageBanner();
?>

<!-- Main Content Begin -->
<div class="main-content-well newsfeed__margin newsfeed-well__width newsfeed-well__background-color">



<div class="generic-content main-content-well newsfeed-well__width container">
	<div class="row">
		<div class="row">
			<div class="col-sm-4">
				<img class="featured-thumbnail-image-custom" src="<?php the_post_thumbnail_url('featured-blogimg-size'); ?>">
				<p class="italic__font smaller-font darker-color"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
			</div>
			<div class="col-sm-8">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

<br>
</div>
</div>
</div>

<?php
	}
?>
<a href="<?php echo site_url('/modern-music-production-and-composition-a-deep-dive-into-the-why-and-the-how') ?>"><div class="single-link--box">Back to Modern Music Production and Composition</div></a>

</section>

<?php get_footer(); ?>