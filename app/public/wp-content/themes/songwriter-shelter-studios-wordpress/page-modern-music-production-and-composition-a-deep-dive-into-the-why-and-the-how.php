<?php
	get_header();

        // Custom WordPress query to get custom post type
        $musicTutorials = new WP_Query([
        'posts_per_page' => 2,
        'post_type' => 'production-tutorials'
      ]);
?>

<section class="page-background no__padding-top">		
<?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  pageBanner();
  $theParent = wp_get_post_parent_id(get_the_ID());
  get_template_part('template-parts/content-returntomainpage');
  }
?>



<!-- Breadcrumb for Parent Pages -->
<?php 
    $theChild = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $theChild) { 
      get_template_part('template-parts/content-pagelinkssidebar');
      ?>


<!-- LEFT OFF HERE (PUTTING REUSABLE CODE IN TEMPLATE PARTS) -->

<!-- Side List of All Posts -->

<div class="page-links side-list__float-left">
        <!-- Maybe link title of Side List to archive for the current post type -->
      <div class="page-links__title"><a href="<?php echo get_post_type_archive_link('production-tutorials') ?>">Modern Music Production and Composition Archive</a></div>
      <ul class="min-list">
        <?php
        while ($musicTutorials->have_posts()) {
          $musicTutorials->the_post();
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


      while($musicTutorials->have_posts()) {
    $musicTutorials->the_post(); ?>
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