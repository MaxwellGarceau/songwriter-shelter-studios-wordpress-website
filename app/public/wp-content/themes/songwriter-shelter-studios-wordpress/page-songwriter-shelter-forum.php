<?php
  get_header();

        // Custom WordPress query to get custom post type

  function wpForumQueryCreator($postType, $author = null) {
        // Posts specific user has made in music philosophy forum
        $forumQuery = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => $postType,
        'author' => $author
      ]);
    return $forumQuery;
  }
      //   // Posts for music philosophy forum
      //   $musicPhilForum = new WP_Query([
      //   'posts_per_page' => -1,
      //   'post_type' => 'music-phil-forum'
      // ]);

      //   // Posts specific user has made in music philosophy forum
      //   $musicPhilForumUser = new WP_Query([
      //   'posts_per_page' => -1,
      //   'post_type' => 'music-phil-forum',
      //   'author' => get_current_user_id()
      // ]);        
?>
    <section class="page-background no__padding-top">
        <?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  // pageBanner([
  //   // 'photo' => wp_upload_dir()['url'] . '/record-player-1500x350.jpg'
  // ]);
  // $theParent = wp_get_post_parent_id(get_the_ID());
  // Return to main page
  // get_template_part('template-parts/content-returntomainpage');
  }
?>
            <div style="padding-top: 100px;"></div>
            <h1 class="forum-title"><?php the_title(); ?></h1>

            <!-- Breadcrumb for Parent Pages -->
            <?php 
    // Resets query from musicPhilForum User to default page query
    wp_reset_query();  

    // $theChild = get_pages(array(
    //   'child_of' => get_the_ID()
    // ));

    // if ($theParent or $theChild) { 
      // Links to other blog pages (right side)
      // get_template_part('template-parts/content-pagelinkssidebar');
      // Archive breadcrumb side list of posts (left side)
        ?>
        <div class="forum-breadcrumb">
          <h2 class="forum-breadcrumb__h2-title">All <?php the_title(); ?> Posts</h2>
      <?php
      // Music Philosophy Forum Master Post List
      forumPostMasterList([
          'query' => wpForumQueryCreator('music-phil-forum'),
          'float-right' => true
        ]); 

      // Songwriting Forum Master Post List
      forumPostMasterList([
          'query' => wpForumQueryCreator('song-discuss-forum'),
          'float-right' => true
        ]);       

      // Songwriting Forum Master Post List
      forumPostMasterList([
          'query' => wpForumQueryCreator('music-prod-forum'),
          'float-right' => true
        ]);   

      // Songwriting Forum Master Post List
      forumPostMasterList([
          'query' => wpForumQueryCreator('off-topic-forum'),
          'float-right' => true
        ]);                 
        ?>
        </div>
                <?php
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

      // MAKE BUTTON IDS DYNAMIC
      forumPostCreateDeleteModifyButtons(wpForumQueryCreator('music-phil-forum', get_current_user_id())); 
      ?>

            <div class="forum-master-container__header">
              <?php wp_reset_query(); ?>
              <h2>Music Philosophy</h2>
                <?php
      // Main Content
      forumMainContent([
        'query' => wpForumQueryCreator('music-phil-forum')
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

      // MAKE BUTTON IDS DYNAMIC
      forumPostCreateDeleteModifyButtons(wpForumQueryCreator('song-discuss-forum', get_current_user_id())); 
      ?>

            <div class="forum-master-container__header">
              <?php wp_reset_query(); ?>
              <h2>Songwriting Discussion</h2>
                <?php
      // Main Content
      forumMainContent([
        'query' => wpForumQueryCreator('song-discuss-forum')
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

      // MAKE BUTTON IDS DYNAMIC
      forumPostCreateDeleteModifyButtons(wpForumQueryCreator('music-prod-forum', get_current_user_id())); 
      ?>

            <div class="forum-master-container__header">
              <?php wp_reset_query(); ?>
              <h2>Music Production and Composition</h2>
                <?php
      // Main Content
      forumMainContent([
        'query' => wpForumQueryCreator('music-prod-forum')
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

      // MAKE BUTTON IDS DYNAMIC
      forumPostCreateDeleteModifyButtons(wpForumQueryCreator('off-topic-forum', get_current_user_id())); 
      ?>

            <div class="forum-master-container__header">
              <?php wp_reset_query(); ?>
              <h2>Off Topic Forum</h2>
                <?php
      // Main Content
      forumMainContent([
        'query' => wpForumQueryCreator('off-topic-forum')
      ]);           
      ?>
            </div>
          </div>
          <!-- End Forum Post Type Section -->          

        </div>  
            <?php echo paginate_links(); ?>
            <?php  
      // } 
    ?>
    </section>
    <?php get_footer();?>