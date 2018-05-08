<?php
  get_header();

        // Custom WordPress query to get custom post type

        // Posts for music philosophy forum
        $musicPhilForum = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'music-phil-forum'
        // 'author' => get_current_user_id()
      ]);

        // Posts specific user has made in music philosophy forum
        $musicPhilForumUser = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'music-phil-forum',
        'author' => get_current_user_id()
        // 'post_status' => 'private'
      ]);        
?>

<section class="page-background no__padding-top">   
<?php
  while(have_posts()) {
  the_post();

  // Custom PHP function to load page banner
  pageBanner();
  $theParent = wp_get_post_parent_id(get_the_ID());
  // Return to main page
  get_template_part('template-parts/content-returntomainpage');
  // upvoteButton();
  }
?>
<button class="user-posts-button" id="user-posts-button">See My Posts</button>
<div class="user-posts" id="user-posts-area" class="user-posts--hidden">
  <?php if (is_user_logged_in()) {
    ?>
  <ul class="user-posts__list" id="user-forum-posts">
  <?php while($musicPhilForumUser->have_posts()) {
    $musicPhilForumUser->the_post();
    ?>
  <!-- User Posts -->
    <li data-id="<?php the_ID(); ?>">
      <input readonly class="user-posts__title" value="<?php echo esc_attr(get_the_title()); ?>">
      <br>
      <textarea readonly class="user-posts__content"><?php echo esc_attr(get_the_content()); ?></textarea>
      <br>
      <span class="edit-forum-post"><i class="fa fa-pencil" aria-hidden="true"> Edit</i></span>
      <span class="delete-forum-post"><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></span>
      <span class="update-forum-post"><i class="fa fa-arrow-right" aria-hidden="true"> Save</i></span>
      <hr class="user-posts__hr">
    </li>
    
  
    <?php
  } ?>
  </ul>
  <?php } else {
    echo '<p>Please log in to see your posts.</p>';
  } ?>
</div>


<!-- Breadcrumb for Parent Pages -->
<?php 
    // Resets query from musicPhilForum User to default page query
    wp_reset_query();
        ?>

    <h4 class="forum-post-header"><?php echo get_the_title(); ?></h4>   
    <hr class="forum-post-title__hr">         
        <?php    
    $theChild = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $theChild) { 
      // Links to other blog pages (right side)
      get_template_part('template-parts/content-pagelinkssidebar');
      // Archive breadcrumb side list of posts (left side)
      pageArchiveBreadCrumb([
          'title' => 'Music Philosophy Forum Archive',
          'post-type' => 'music-phil-forum',
          'query' => $musicPhilForum
        ]); 
      // Main Content
      forumMainContent([
        'query' => $musicPhilForum
      ]);           
      ?>
      <div>
        <h4>Make a Post</h4>
        <input placeholder="Title" class="new-forum-post-title">
        <hr class="forum-post-title__hr">
        <textarea placeholder="Your post here..." class="new-forum-post-body-field"></textarea>
        <span class="create-forum-post">Create Post</span>
      </div>
<?php echo paginate_links(); ?>

    <?php  
      } 
    ?>




</section>
  <?php get_footer();?>