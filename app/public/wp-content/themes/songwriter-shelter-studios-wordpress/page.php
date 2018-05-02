<?php
	get_header();
  ?>
<section class="page-background no__padding-top">
<?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  pageBanner();
  ?>


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

<?php 
  }
?>

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

        <?php  
      } 
    ?>

<!-- Blog Page Listings (PUT IMAGES HERE AND LINK TO THE IMAGES) -->
<div class="blog-landing">
  <h2>Blog Pages</h2>
<ul>
<?php 
   wp_list_pages([
    'child_of' => 44,
    'title_li' => NULL
  ]);
?>
</ul>
</div>

<?php echo paginate_links(); ?>




</section>
	<?php get_footer();?>