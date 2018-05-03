<?php $blogParentPage = 44; ?>    
    <div class="page-links">
      <div class="page-links__title"><a href="<?php echo get_permalink($blogParentPage); ?>"><?php echo get_the_title($blogParentPage); ?></a></div>
      <ul class="min-list">
        <?php 
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $blogParentPage,
            'sort_column' => 'menu_order'
          )); 
          ?>
      </ul>
    </div>