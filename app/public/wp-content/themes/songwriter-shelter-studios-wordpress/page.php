<?php
get_header();
?>
<section class="page-background no__padding-top">
<?php
while (have_posts()) {
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
    'child_of' => get_the_ID(),
));

if ($theParent or $theChild) {
    get_template_part('template-parts/content-pagelinkssidebar');
}
?>

<!-- Blog Page Listings (PUT IMAGES HERE AND LINK TO THE IMAGES) -->
<div class="blog-landing">
<!--   <h2 class="no__padding-top">Blog Pages</h2> -->
  <div class="container">
<ul class="blog-landing__list blog-landing__well row">
<?php
wp_list_pages([
    'child_of' => get_the_ID(),
    'title_li' => null,
]);
?>
</ul>
<div class="row display-none--900 justify--center">
    <?php
$blogPostTypes = ['songwriter-salon', 'songwriter-advice', 'production-tutorials'];

foreach ($blogPostTypes as $postType) {
    $recentPosts = wp_get_recent_posts([
        'numberposts' => 1,
        'post_type'   => $postType,
    ]);
    ?>
    <div class="col-sm-3">
      <h6>Recent Posts</h6>
<a class="inverse-link-color" href="<?php echo get_permalink($recentPosts[0]['ID']) ?>">
  <div class="font-italic smaller-font">
      <?php
echo $recentPosts[0]['post_title'];
    ?>
  </div>
</a>
    </div>
      <?php }?>

</div>
</div>
</div>

<?php echo paginate_links(); ?>

</section>
  <?php get_footer();?>