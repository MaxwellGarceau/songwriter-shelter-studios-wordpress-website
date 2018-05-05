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

<!-- Blog Page Listings (PUT IMAGES HERE AND LINK TO THE IMAGES) -->
<div class="blog-landing">
  <h2>Blog Pages</h2>
  <?php userRegistrationButtons(); ?>
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