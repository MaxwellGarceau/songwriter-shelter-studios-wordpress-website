<?php
	get_header();

      // Custom WordPress query to get custom post type
      $mainPage = 48;
      $blogParentPage = 44;
  ?>

<section class="page-background no__padding-top">		
  <?php
  // Custom PHP function to load page banner
  pageBanner([
    'title' => 'Songwriter Advice From A Nashville Producer Archive'
  ]);
  // Return to main page
  archiveReturnToMainPage($mainPage);
  // Side bar links (right side)
  get_template_part('/template-parts/archivecontent-pagelinkssidebar');
  // Main content
  get_template_part('/template-parts/archivecontent-maincontent');  
?>

</section>
	<?php get_footer();?>