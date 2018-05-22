<div class="main-content-well newsfeed__margin newsfeed-well__background-color archive-title">
    <!-- Maybe link title of Side List to archive for the current post type -->
    <h6 class="newsfeed-post-title">All Posts</h6>
    <ul class="min-list">
        <?php

        $authorArchiveQuery = new WP_Query([
          'post_type' => ['songwriter-salon', 'songwriter-advice', 'production-tutorials', 'Post']
        ]);

        while ($authorArchiveQuery->have_posts()) {
          $authorArchiveQuery->the_post();

          // Implement later
          
          // // Display different layouts for custom post types
          // $id = get_the_ID();
          // $post_type = get_post_type($id);
          // if ($post_type == 'songwriter-salon' OR $post_type == 'songwriter-advice' OR $post_type == 'production-tutorials') {
          //     // include(locate_template('template-parts/archivecontent-custompostlayout.php')); 
          //   get_template_part('./archivecontent-custompostlayout');
          // }
          //     // include(locate_template('parts/entry-blog.php'));
          ?>
            <li>
                <a class="inverse-link-color" href="<?php echo the_permalink(); ?>">
            <?php
            echo the_title();
            ?>
                </a>
                -
                <span class="italic__font smaller-font"><?php echo get_the_date('F Y'); ?></span>
            </li>
            <p>
                <div class="flex-archive-container">
          <?php 
          if(empty(get_the_content())) {
            echo custom_field_excerpt('main_body_content', 10);
          } else {
            echo wp_trim_words(get_the_excerpt(), 10);
          }?>
                </div>
            </p>
            <br>
            <?php }?>
    </ul>
</div>