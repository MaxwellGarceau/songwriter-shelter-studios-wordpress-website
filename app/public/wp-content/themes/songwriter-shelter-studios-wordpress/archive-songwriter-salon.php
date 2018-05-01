<?php
	get_header();

      // Custom WordPress query to get custom post type
      $mainPage = 51;
      $blogParentPage = 44;
  ?>

<section class="page-background">		
		<h1 class="blog-title__font blog-title__margin">Songwriter Salon Archive</h1>
		<hr class='no__margin-bottom'>


<!-- Breadcrumb for Children Pages -->
<div class="breadcrumb-container">
<?php 
$theParent = wp_get_post_parent_id(get_the_ID());
  if (true) { 
    ?>
      <div class="metabox">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('songwriter-shelter-studios-blog-pages/songwriter-salon-music-philosophy-in-the-21st-century/'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($mainPage); ?></a> 
      	<br>
      <span class="metabox__main breadcrumb--title-text"><?php echo get_the_title($mainPage); ?></span></p>
    </div>
<?php  
}
 ?>
</div>

<!-- Breadcrumb for Parent Pages -->
    <div class="page-links">
      <div class="page-links__title"><a href="<?php echo get_permalink($blogParentPage); ?>"><?php echo get_the_title($blogParentPage); ?></a></div>
      <ul class="min-list">
        <?php 
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $blogParentPage,
            'sort_column' => 'menu_order'
          )); 
          ?>
      </ul>
    </div>

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