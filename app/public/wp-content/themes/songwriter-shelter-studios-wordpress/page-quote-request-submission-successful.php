<?php
	get_header();
  ?>
    <section class="quote-request-submission-background no__padding-top">
        <?php
  while(have_posts()) {
  the_post();
  }
?>
			<!-- Implement later -->
            <!-- Blog Page Listings (PUT IMAGES HERE AND LINK TO THE IMAGES) -->
            <div class="blog-landing no-pagebanner-title">
                <h2 class="quote-request-confirmation">Your quote request was submitted successfully!</h2>
                <div class="italic__font">
                    <a class="inverse-link-color" href="<?php echo get_site_url('/'); ?>">Click here to go back to The Songwriter Shelter Recording Studios.</a>
                </div>
            </div>
    </section>
<?php get_footer();?>