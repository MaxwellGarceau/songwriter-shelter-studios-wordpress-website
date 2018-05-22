<?php
get_header();
// Custom WordPress query to get custom post type
$songwriterSalon = new WP_Query([
    'posts_per_page' => 2,
    'post_type'      => 'songwriter-salon',
]);
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
    // Links to other blog pages (right side)
    get_template_part('template-parts/content-pagelinkssidebar');
    // Archive breadcrumb side list of posts (left side)
    pageArchiveBreadCrumb([
        'title'     => 'The Songwriter Salon Archive',
        'post-type' => 'songwriter-salon',
        'query'     => $songwriterSalon,
    ]);
    // Main Content
    pageMainContent([
        'query' => $songwriterSalon,
    ]);
    ?>
<div class="<?php if ($songwriterSalon->found_posts > 2) {
        echo 'paginate-links';
    }?>">
<?php
echo paginate_links([
        'total' => $songwriterSalon->max_num_pages,
    ]);
    ?>
</div>
<?php }?>

</section>
  <?php get_footer();?>