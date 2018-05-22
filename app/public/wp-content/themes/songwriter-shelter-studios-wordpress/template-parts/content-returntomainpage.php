<?php
$theParent = wp_get_post_parent_id(get_the_ID());
if ($theParent) {?>
<!-- Breadcrumb for Children Pages -->
<div class="breadcrumb-container margin__top">
    <div class="metabox">
        <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a>
            <br>
        </p>
    </div>
</div>
<?php }?>