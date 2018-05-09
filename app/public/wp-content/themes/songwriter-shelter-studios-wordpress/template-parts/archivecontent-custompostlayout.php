<div class="flex-archive-child">
<?php 
          if(empty(get_the_content())) {
            echo custom_field_excerpt('main_body_content', 10);
          } else {
            echo wp_trim_words(get_the_excerpt(), 10);
          }
?>
<!-- <p>WORKING</p> -->
</div>