<?php
get_header();

// Custom WordPress query to get custom post type

function wpForumQueryCreator($postType, $author = null)
{
    // Posts specific user has made in music philosophy forum
    $forumQuery = new WP_Query([
        'posts_per_page' => -1,
        'post_type'      => $postType,
        'author'         => $author,
    ]);
    return $forumQuery;
}

?>
    <section class="page-background no__padding-top">
        <?php
while (have_posts()) {
    the_post();

}
?>
            <div style="padding-top: 90px;"></div>
            <h1 class="forum-title"><?php the_title();?></h1>

            <?php
// Resets query from musicPhilForum User to default page query
wp_reset_query();

?>
        <div class="forum-breadcrumb">
          <h2 class="forum-breadcrumb__h2-title">All <?php the_title();?> Posts</h2>
      <?php
// Music Philosophy Forum Master Post List
forumPostMasterList([
    'query'       => wpForumQueryCreator('music-phil-forum'),
    'float-right' => true,
]);

// Songwriting Forum Master Post List
forumPostMasterList([
    'query'       => wpForumQueryCreator('song-discuss-forum'),
    'float-right' => true,
]);

// Songwriting Forum Master Post List
forumPostMasterList([
    'query'       => wpForumQueryCreator('music-prod-forum'),
    'float-right' => true,
]);

// Songwriting Forum Master Post List
forumPostMasterList([
    'query'       => wpForumQueryCreator('off-topic-forum'),
    'float-right' => true,
]);
?>
        </div>
                <?php

// Implement later

// Attempt 1

// $postTimeRestriction = new WP_Query([
//   'post_type' => 'music-phil-forum',
//   'date_query' => [
//     'after' => [
//       'year' => 2018,
//       'month' => 5,
//       'day' => 7
//     ],
//   ],
// ]);
// while ($postTimeRestriction->have_posts()) {
//   $postTimeRestriction->the_post();
//   echo $postTimeRestriction->post_count();
// }

// Attempt 2

// $querystr = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'music-phil-forum' AND post_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) LIMIT 0, 30");
// if (0 < $querystr) $querystr = number_format($querystr);
// echo $querystr;
// count_user_posts(get_current_user_id())
?>

      <div class="forum-master-container">

        <!-- Begin Forum Post Type Section (Music Philosophy)-->
        <div class="forum-master-container__subsection">

      <!-- Forum Buttons -->
      <?php
wp_reset_query();

forumPostCreateDeleteModifyButtons(wpForumQueryCreator('music-phil-forum', get_current_user_id()));
?>

            <div class="forum-master-container__header">
              <?php wp_reset_query();?>
              <h2 class="forum-master-container__subsection-title">Music Philosophy</h2>
                <?php
// Main Content
forumMainContent([
    'query' => wpForumQueryCreator('music-phil-forum'),
]);
?>
            </div>
          </div>
          <!-- End Forum Post Type Section -->

        <!-- Begin Forum Post Type Section (Songwriting)-->
        <div class="forum-master-container__subsection">

      <!-- Forum Buttons -->
      <?php
wp_reset_query();

forumPostCreateDeleteModifyButtons(wpForumQueryCreator('song-discuss-forum', get_current_user_id()));
?>

            <div class="forum-master-container__header">
              <?php wp_reset_query();?>
              <h2 class="forum-master-container__subsection-title">Songwriting Discussion</h2>
                <?php
// Main Content
forumMainContent([
    'query' => wpForumQueryCreator('song-discuss-forum'),
]);
?>
            </div>
          </div>
          <!-- End Forum Post Type Section -->

        <!-- Begin Forum Post Type Section (Music Production)-->
        <div class="forum-master-container__subsection">

      <!-- Forum Buttons -->
      <?php
wp_reset_query();

forumPostCreateDeleteModifyButtons(wpForumQueryCreator('music-prod-forum', get_current_user_id()));
?>

            <div class="forum-master-container__header">
              <?php wp_reset_query();?>
              <h2 class="forum-master-container__subsection-title">Music Production and Composition</h2>
                <?php
// Main Content
forumMainContent([
    'query' => wpForumQueryCreator('music-prod-forum'),
]);
?>
            </div>
          </div>
          <!-- End Forum Post Type Section -->

        <!-- Begin Forum Post Type Section (Off Topic)-->
        <div class="forum-master-container__subsection">

      <!-- Forum Buttons -->
      <?php
wp_reset_query();

forumPostCreateDeleteModifyButtons(wpForumQueryCreator('off-topic-forum', get_current_user_id()));
?>

            <div class="forum-master-container__header">
              <?php wp_reset_query();?>
              <h2 class="forum-master-container__subsection-title">Off Topic Forum</h2>
                <?php
// Main Content
forumMainContent([
    'query' => wpForumQueryCreator('off-topic-forum'),
]);
?>
            </div>
          </div>
          <!-- End Forum Post Type Section -->

        </div>
            <?php echo paginate_links(); ?>

    </section>
    <?php get_footer();?>