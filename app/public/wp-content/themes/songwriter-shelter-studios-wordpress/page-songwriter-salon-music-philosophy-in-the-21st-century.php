<?php
	get_header();

      // Custom WordPress query to get custom post type
      $songwriterSalon = new WP_Query([
        'posts_per_page' => 2,
        'post_type' => 'songwriter-salon'
      ]);  
  ?>

<section class="page-background">		
		<h1 class="blog-title__font blog-title__margin"><?php the_title(); ?></h1>
		<hr class='no__margin-bottom'>


<!-- Breadcrumb for Children Pages -->
<div class="breadcrumb-container">
<?php 
$theParent = wp_get_post_parent_id(get_the_ID());
  if ($theParent) { 
    ?>
      <div class="metabox">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> 
      	<br>
      <span class="metabox__main breadcrumb--title-text"><?php the_title(); ?></span></p>
    </div>
<?php  
}
 ?>
</div>

<!-- Breadcrumb for Parent Pages -->
<?php 
    $theChild = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $theChild) { ?>

    <div class="page-links">
      <div class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></div>
      <ul class="min-list">
        <?php 
        if ($theParent) {
          $findChildrenOf = $theParent;
        } else {
          $findChildrenOf = get_the_ID();
        }
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          )); 
          ?>
      </ul>
    </div>

<!-- Side List of All Posts -->

<div class="page-links side-list__float-left">
        <!-- Maybe link title of Side List to archive for the current post type -->
      <div class="page-links__title"><a href="<?php echo get_post_type_archive_link('songwriter-salon') ?>">Songwriter Salon Archive</a></div>
      <ul class="min-list">
        <?php
        while ($songwriterSalon->have_posts()) {
          $songwriterSalon->the_post();
          ?>

        <li>
          <a href="<?php echo the_permalink(); ?>">            
            <?php
            echo the_title();
            ?> 
          </a>          
        </li>

        <?php
         }
          ?>
      </ul>
    </div>

    <!-- Custom Post Type Query -->
    <div class="page--posts">
    <?php 

      while($songwriterSalon->have_posts()) {
    $songwriterSalon->the_post(); ?>
<!-- Post Body -->
<div class="main-content-well newsfeed__margin newsfeed-well__background-color">
<h6 class="newsfeed-post-title"><?php the_title(); ?></h6>

<div class="meta-box">
  <span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F, Y'); ?></span>
</div>



<div class="generic-content main-content-well newsfeed-well__width">
<?php the_excerpt(); ?>
<br>
<span><a href="<?php the_permalink(); ?>">Continue Reading &raquo;</a></span>
</div>
</div>
</div>

<?php
  }
?>
<?php echo paginate_links(); ?>

    <?php  
      } 
    ?>




</section>
	<?php get_footer();?>