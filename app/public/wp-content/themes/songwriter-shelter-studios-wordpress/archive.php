<?php
	get_header();
  ?>

<section class="page-background no__padding-top">		
  <?php
  // Custom PHP function to load page banner
  pageBanner([
    'title' => get_the_archive_title()
  ]);
  // Main content
  get_template_part('/template-parts/archivecontent-maincontent'); 
?>

</section>
	<?php get_footer();?>