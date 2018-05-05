<?php
	get_header();
  ?>
<section class="page-background no__padding-top">
<?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  pageBanner();
  $theParent = wp_get_post_parent_id(get_the_ID());
  // Return to main page
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
      } 
    ?>

<!-- Search Form -->
<div class="generic-content main-content-well">
  <form method="get" action="<?php echo esc_url(site_url('/')); ?>">
    <label for="s">Type Here To Perform A Search</label>
    <br>
    <input class="search-bar" type="search" name="s" placeholder="Search Here">
    <input class="search-button" type="submit" value="Search">
  </form>
</div>





</section>
	<?php get_footer();?>