<?php
	get_header();
	while(have_posts()) {
		the_post(); ?>
<section style="background-color: black">		
		<h1 class="blog-title__font blog-title__margin"><?php the_title(); ?></h1>
		<hr>


<!-- Breadcrumb for Children Pages -->
<div class="breadcrumb-container">
<?php 
$theParent = wp_get_post_parent_id(get_the_ID());
  if ($theParent) { 
    ?>
      <div class="metabox">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> 
      	<br>
      <span class="metabox__main"><?php the_title(); ?></span></p>
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
    <?php  
      } 
    ?>


		<div>
			<?php the_content(); ?>
		</div>

</section>
	<?php } get_footer();?>