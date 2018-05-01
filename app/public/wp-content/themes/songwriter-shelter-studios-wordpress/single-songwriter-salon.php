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
<?php 
	$relatedAdvice = get_field('related_advice');
	
	if ($relatedAdvice) {
		echo '<hr>';
		echo '<h4 class="related-post--title">Related Posts(s)</h4>';
		echo '<ul class="related-post--list">';
		foreach($relatedAdvice as $advice) { ?>
			<li><a href="<?php echo get_the_permalink($advice); ?>"><?php echo get_the_title($advice)?></a></li>
	<?php }
		echo '</ul>';
	}
	?>	

</div>
</div>
</div>

<?php
	}
?>
<a href="<?php echo site_url('/songwriter-salon-music-philosophy-in-the-21st-century') ?>"><div class="single-link--box">Back to the Songwriter Salon</div></a>

</section>

<?php get_footer(); ?>