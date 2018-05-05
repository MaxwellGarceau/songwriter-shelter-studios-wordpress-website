<?php
	get_header();
  ?>

<section class="page-background no__padding-top">		
  <?php
  // Custom PHP function to load page banner
  pageBanner([
    'title' => 'Search Results'
  ]);
  ?>
  <h6>Your last search was for: <?php echo esc_html(get_search_query(false)); ?></h6>
  <!-- Search Form -->
<div class="generic-content main-content-well">
  <form method="get" action="<?php echo esc_url(site_url('/')); ?>">
    <label for="s">Type Here To Perform A Search</label>
    <br>
    <input class="search-bar" type="search" name="s" placeholder="Search Here">
    <input class="search-button" type="submit" value="Search">
  </form>
</div>
  <?php
  // Main content
  get_template_part('/template-parts/archivecontent-maincontent');   
?>

</section>
	<?php get_footer();?>