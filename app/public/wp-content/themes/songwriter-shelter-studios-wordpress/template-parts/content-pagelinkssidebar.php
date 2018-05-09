    <?php 
    $theParent = wp_get_post_parent_id(get_the_ID());
    $mainForumPage = 119; 
    ?>
    <div class="page-links">
      <div class="page-links__title <?php if ($theParent == $mainForumPage OR is_page($mainForumPage)) {
        echo 'page-links__forum-background';
      } else {
        echo 'page-links__main-background';
      } ?>"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></div>
      <ul class="min-list">
        <?php 
        if ($theParent) {
          $findChildrenOf = $theParent;
        } else {
          $findChildrenOf = get_the_ID();
        }
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          )); 
          ?>
      </ul>
    </div>