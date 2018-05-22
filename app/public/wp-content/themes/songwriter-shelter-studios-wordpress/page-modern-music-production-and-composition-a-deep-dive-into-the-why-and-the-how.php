<?php
get_header();

// Custom WordPress query to get custom post type
$musicTutorials = new WP_Query([
    'paged'          => get_query_var('paged', 1),
    'posts_per_page' => 2,
    'post_type'      => 'production-tutorials',
]);
?>

<section class="page-background no__padding-top">
<?php
while (have_posts()) {
    the_post();

    // Custom PHP function to load page banner
    ?>
  <div class="music-production__page-banner">
    <?php
pageBanner(['title' => '<span class="music-production__title">Modern Music Production and Composition<br><span class="blog-title--smaller blog-title--smaller-color">A Deep Dive Into The "Why" And The "How"</span></span>']);
    ?>
  </div>
  <?php
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
    // Links to other blog pages (right side)
    get_template_part('template-parts/content-pagelinkssidebar');
    // Archive breadcrumb side list of posts (left side)
    pageArchiveBreadCrumb([
        'title'     => 'Modern Music Production and Composition Archive',
        'post-type' => 'production-tutorials',
        'query'     => $musicTutorials,
    ]);
    // Main Content
    pageMainContent([
        'query' => $musicTutorials,
    ]);
    ?>
<div class="<?php if ($musicTutorials->found_posts > 2) {
        echo 'paginate-links';
    }
    ?>">
<?php
echo paginate_links([
        'total' => $musicTutorials->max_num_pages,
    ]);
    ?>
</div>
    <?php
}
?>

</section>
  <?php get_footer();?>