<?php
	get_header();
  ?>
<section class="page-background no__padding-top">
<?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  // pageBanner();
  $theParent = wp_get_post_parent_id(get_the_ID());
  // Return to main page
  get_template_part('template-parts/content-returntomainpage');
  }
?>
<div class="no-pagebanner-title"></div>
<h2 class="default-search__title">Search</h2>
<!-- Breadcrumb for Parent Pages -->
<?php 
    $theChild = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $theChild) { 
      get_template_part('template-parts/content-pagelinkssidebar');      
      } 
    ?>

<!-- Search Form -->
<div class="generic-content main-content-well">
<?php get_search_form(); ?>
</div>
<!-- <div style="padding-bottom: 500px;"></div> -->




</section>
	<?php get_footer();?>