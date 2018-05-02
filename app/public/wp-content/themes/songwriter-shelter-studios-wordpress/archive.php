<?php
	get_header();
  ?>

<section class="page-background no__padding-top">		
  <?php
  // Custom PHP function to load page banner
  pageBanner([
    'title' => get_the_archive_title()
  ]);
?>

<!-- Side List of All Posts -->

<div class="main-content-well newsfeed__margin newsfeed-well__background-color archive-title">
        <!-- Maybe link title of Side List to archive for the current post type -->
        <h6 class="newsfeed-post-title">All Posts</h6>
      <ul class="min-list">
        <?php
        // while ($mainPageQuery->have_posts()) {
        //   $mainPageQuery->the_post();        
        while (have_posts()) {
          the_post();
          ?>

        <li>
          <a href="<?php echo the_permalink(); ?>">            
            <?php
            echo the_title();
            ?> 
          </a>   
                    -
          <span class="italic__font smaller-font"><?php echo get_the_date('F Y'); ?></span>           
        </li>

        <p>
        	<?php echo wp_trim_words(get_the_excerpt(), 10); ?>
        </p>
        <br>

        <?php
         }
          ?>
      </ul>
    </div>




</section>
	<?php get_footer();?>