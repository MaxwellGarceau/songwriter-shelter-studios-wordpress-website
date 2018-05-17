<div class="default-search__well newsfeed__margin newsfeed-well__background-color">
    <!-- Maybe link title of Side List to archive for the current post type -->
    <div class="no-pagebanner-title"></div>
    <h6 class="newsfeed-post-title default-search__title default-search__title--results">All Posts</h6>
    <ul class="min-list default-search__results-list">
        <?php
        // while ($mainPageQuery->have_posts()) {
        //   $mainPageQuery->the_post();    
        while (have_posts()) {
          the_post();

          // // Display different layouts for custom post types
          // $id = get_the_ID();
          // $post_type = get_post_type($id);
          // if ($post_type == 'songwriter-salon' OR $post_type == 'songwriter-advice' OR $post_type == 'production-tutorials') {
          //     // include(locate_template('template-parts/archivecontent-custompostlayout.php')); 
          //   get_template_part('./archivecontent-custompostlayout');
          // }
          //     // include(locate_template('parts/entry-blog.php'));          
          ?>
            <li class="default-search__results-list-item">
                <a class="inverse-link-color" href="<?php echo the_permalink(); ?>">
                    <?php
            echo the_title();
            ?>
                </a>
                -
                <span class="italic__font smaller-font"><?php echo get_the_date('F Y'); ?></span>
                <div>
                    <?php
             
          if(empty(get_the_content())) {
            echo custom_field_excerpt('main_body_content', 10);
          } else {
            echo wp_trim_words(get_the_excerpt(), 10);
          }

           ?>
                </div>
            </li>
            <?php
         }
          ?>
    </ul>
</div>