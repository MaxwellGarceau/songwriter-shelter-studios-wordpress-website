<?php
	get_header();
  ?>

<section class="page-background no__padding-top">		
  <?php
  // Custom PHP function to load page banner
  // pageBanner([
  //   'title' => 'Search Results'
  // ]);
  ?>
  <?php
  if (have_posts()) {
      // Main content
    get_template_part('/template-parts/search-results');   
    echo paginate_links();
  } else {
    echo '<h5 class="no-pagebanner-title">Sorry, No results.</h5>';   
  } 
  ?>
<h6>Your last search was for: <?php echo esc_html(get_search_query(false)); ?></h6>  
    <!-- Search Form -->
<div class="generic-content main-content-well">
<?php get_search_form(); ?>
</div>


</section>
	<?php get_footer();?>