    <?php $theParent = wp_get_post_parent_id(get_the_ID()); ?>
    <div class="page-links">
      <div class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></div>
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