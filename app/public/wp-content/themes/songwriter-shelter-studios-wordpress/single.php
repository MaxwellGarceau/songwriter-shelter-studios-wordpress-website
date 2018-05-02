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
</div>
</div>
</div>

<?php
	}
?>
<a href="<?php echo site_url('/songwriter-shelter-studios-blog-pages') ?>"><div class="single-link--box">Back to Main Blog</div></a>

</section>

<?php get_footer(); ?>