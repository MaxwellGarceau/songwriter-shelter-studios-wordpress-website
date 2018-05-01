<?php get_header() ?>
<section class="page-background">
<!-- <div class="single-post__margin"></div> -->
<?php 

while(have_posts()) {
	the_post();
?>
<div class="main-content-well newsfeed__margin newsfeed-well__width newsfeed-well__background-color">
<h6 class="newsfeed-post-title"><?php the_title(); ?></h6>

<div class="meta-box">
  <span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
</div>



<div class="generic-content main-content-well newsfeed-well__width">
<?php the_content(); ?>
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