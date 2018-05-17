<?php get_header(); ?>
<!-- Home page -->
<section id="home" class="well__medium-top-margin home-content">
    <div class="well__title well__circle">
        <h1><span class="h1-primary__font-size"> The Songwriter Shelter</span>
        <br>
        <span class="h1-secondary__font-size h1-secondary__font-family h1-secondary__margin">Recording Studios</span>
    </h1>
    </div>
    <div class="well__title well__max-width well__small-margin-padding well__small-width">
        <h3 class="italic__font">Fully Produced and Arranged Recordings for Singer/Songwriters Who Want To Hear Their Music Come To Life</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p>
                    "Working with Max at The Songwriter Shelter Recording Studios has definitely changed me as an artist. I have worked with him for almost a year now and have recorded 3 separate projects. Max definitely takes the heart and soul of the songs and project in mind. Being a musician himself he understands the need for musicians to be comfortable and feel like the best work is going to be done with their creations. I have never felt more confident to show my music to people as I have with the work that Max has produced."

                    <br> -Jake Parker
                    <br>
                </p>
            </div>
            <div class="col-sm-4">
                <a href="<?php echo site_url('#request-a-quote') ?>" class="js-scroll-trigger">
                    <button type="button" class="main-button main-button__lg-font bold__font title__font">Request A Quote</button>
                </a>
                <br>
                <div class="well__title well__bgcolor-white well__max-width main-button">
                    <div class="margin__bottom">Full Production (Before and After)</div>
                    <div>
                        <?php 
    echo do_shortcode(get_post(42)->post_content);
    ?>
                    </div>
                </div>
                <!-- Music Player Goes Here -->
            </div>
            <div class="col-sm-4">
                <p>
                    "Working with Max Garceau at The Songwriter Shelter Recording Studios was a great experience. He is extremely knowledgeable and cares deeply about his work. I recorded a full length album with him and would recommend him to anyone! He is experienced with different styles of music and really put in the time and effort to make my album sound incredible!"
                    <br> -Fawn Larson
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Services -->

<section id="services">
    <div class="well__title no__padding">
        <h2>
        SERVICES
    </h2>
        <hr>
    </div>
    <div class="container well__title well__max-width">
        <div class="row">
            <div class="col-lg-4">
                <img class="services-pics" src="<?php echo site_url('/wp-content/themes/songwriter-shelter-studios-wordpress/images/mixer.svg');?>">
                <br>
                <span class="subtitle-main">Mixing/Mastering</span>
                <hr class="subtitle-hr">
                <br>
                <p class="no__margin-padding no__well">
                    Send me raw tracks recorded anywhere from a bedroom to a professional studio and I'll give you back a professional product.
                </p>
            </div>
            <div class="col-lg-4">
                <img class="services-pics" src="<?php echo site_url('/wp-content/themes/songwriter-shelter-studios-wordpress/images/guitar.svg'); ?>">
                <br>
                <span class="subtitle-main">Composition</span>
                <hr class="subtitle-hr">
                <br>
                <p class="no__margin-padding no__well">
                    Have a great song, but having trouble writing the music and arranging the instruments? I can write AND record the music for you so all you have to do is focus on your song.
                </p>
            </div>
            <div class="col-lg-4">
                <img class="services-pics" src="<?php echo site_url('/wp-content/themes/songwriter-shelter-studios-wordpress/images/microphone.svg'); ?>">
                <br>
                <span class="subtitle-main">Recording</span>
                <hr class="subtitle-hr">
                <br>
                <p class="no__margin-padding no__well">
                    If you've got the songs I've got the skills to bring your vision to life. From the studio to a live performance I can capture the magic.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- My Work -->
<section id="my-work">
    <div class="well__title no__padding">
        <h2>
        Before &amp; After
    </h2>
        <hr>
    </div>
    <div class="music-player">
        <?php 
    echo do_shortcode(get_post(22)->post_content);
    ?>
    </div>
    <div class="well__title no__padding">
        <h2>
        My Work
    </h2>
        <hr>
    </div>
    <div class="music-player">
        <?php 
    echo do_shortcode(get_post(25)->post_content);
    ?>
    </div>
    <div class="well__title no__padding">
        <h2>
        Live Recording
    </h2>
        <hr>
    </div>
    <div class="iframe-div">
        <iframe src="//www.youtube.com/embed/ojb8czav2f0" frameborder="0"></iframe>
    </div>
    <div class="iframe-div">
        <iframe src="//www.youtube.com/embed/kaD2DDGPNrI" frameborder="0"></iframe>
    </div>
</section>
<!-- Testimonials -->
<section id="testimonials" class="testimonials-bg-pic">
    <div class="well__title no__padding">
        <h2>
        TESTIMONIALS
    </h2>
        <hr>
    </div>
    <p>Working with Max at The Songwriter Shelter Recording Studios has definitely changed me as an artist. I have worked with him for almost a year now and have recorded 3 separate projects. Max definitely takes the heart and soul of the songs and project in mind. Being a musician himself he understands the need for musicians to be comfortable and feel like the best work is going to be done with their creations. I recomend him to everyone I know because he cares about music and cares about the product that comes out. I have never felt more confident to show my music to people as I have with the work that Max has produced.
        <br>
        <span class="subtitle-main">-Jake Parker</span>
    </p>
    <p>
        "Working with Max Garceau at The Songwriter Shelter Recording Studios was a great experience. He is extremely knowledgeable and cares deeply about his work. I recorded a full length album with him and would recommend him to anyone! He is experienced with different styles of music and really put in the time and effort to make my album sound incredible!"
        <br>
        <span class="subtitle-main">-Fawn Larson</span>
    </p>
    <p>
        "Max is a joy to work with. He's organized, professional, and knows how to turn an artist's musical vision into something spectacular!"
        <br>
        <span class="subtitle-main">-Brad Owens</span>
    </p>
    <p>
        Working with Max was an absolute pleasure. I had little prior experience in recording and engineering. I had only made demos in my bedroom that I thought would be fun to put out to the world. Through a friend of mine, he recommended Max to help me record my music.
        <br>
        <br> I value prompt communication and punctuality. This made Max made a perfect first impression because he would always text or call me back in a timely manner and always was on time.
        <br>
        <br> Max takes the time to really study the songs that he's working on. He puts in the time in pre-production to hear what the song could become. Then during the recording process he brings out not only the best tones possible, but also brings out the best performances as possible. He does it without being overbearing and will not tear you down as a musician or writer if something wasn't the best it could be.
        <br>
        <br> I can now say that through the whole learning process I have learned so much from Max about writing and recording that the next project I do, it will be better because of what I learned while working with Max. As an added bonus, I feel like when I work with Max again, we will be able to take my songs further because we both know how each other work.
        <br>
        <br> I highly recommend Max for any production or engineering work you need. I know I will be using him again for my next project. He's awesome.
        <br>
        <br> (5/5 Stars)
        <br>
        <span class="subtitle-main">-Gabe Wateski</span>
    </p>
</section>
<!-- About -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="well__title col-sm-6">
                <h2>About</h2>
                <h3>Max Garceau</h3>
                <hr>
                <p class="no__margin-padding">
                    Graduating from Berklee College of Music in 2013 Max has been honing his skills in recording studios both large and small. Interning at Boston’s premiere recording location, Q Division Studios, Max has had experience assisting and recording sessions for several of Boston’s best musicians. Currently living in Nashville, TN and operating out of a wide range of recording studios, Max works as a full time musical freelancer producing, songwriting with, recording, and mixing/mastering bands ranging in genre from acoustic to pop and modern rock.
                </p>
                <br>
                <hr>
                <a href="https://soundcloud.com/songwritershelterstudios" target="_blank"><span class="subtitle-main discography-shadow text__reg-color">To Hear Max's Full Discography Click Here</span></a>
            </div>
        </div>
    </div>
</section>
<!-- Request A Quote -->
<section id="request-a-quote">
    <div class="well__title no__padding">
        <h2>
        Request A Quote
    </h2>
        <hr>
    </div>
    <div class="well__title well__medium-width">
            <form class="contact-form" data-formid="5" method="post" enctype="multipart/form-data" action="https://formspree.io/max@songwritershelterstudios.com" method="POST" novalidate="novalidate">
                <div>
                    <div data-field-id="0">
                        <label class="contact-form__label" for="Artist/Band Name">Artist/Band Name <span class="contact-form__required-indicator">*</span></label>
                        <input class="contact-form__field" type="text" name="Artist/Band Name" required="" aria-required="true">
                    </div>
                    <div data-field-id="1">
                        <label class="contact-form__label" for="Email Address">Email Address <span class="contact-form__required-indicator">*</span></label>
                        <input class="contact-form__field" type="email" name="Email Address" required="" aria-required="true">
                    </div>
                    <div data-field-id="3">
                        <label class="contact-form__label" for="Contact Name">Contact Name</label>
                        <input class="contact-form__field" type="text" name="Contact Name">
                    </div>
                    <div data-field-id="4">
                        <label class="contact-form__label" for="Location (City, State)">Location (City, State) <span class="contact-form__required-indicator">*</span></label>
                        <input class="contact-form__field" type="text" name="Location (City, State)" required="" aria-required="true">
                    </div>
                    <div data-field-id="5">
                        <label class="contact-form__label" class="wpforms-field-label" for="Genre">Genre</label>
                        <input class="contact-form__field" type="text" name="Genre">
                    </div>
                    <div data-field-id="10">
                        <label class="contact-form__label" for="wpforms-5-field_10">Project Needs <span class="contact-form__required-indicator">*</span></label>
                        <ul class="contact-form__checkbox">
                            <li>
                                <input type="checkbox" name="Recording" value="Recording" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Recording">Recording</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Mixing" value="Mixing" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Mixing">Mixing</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Mastering" value="Mastering" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Mastering">Mastering</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Track Building (Making the instrumental section of the song)" value="Track Building (Making the instrumental section of the song)" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Track Building (Making the instrumental section of the song)">Track Building (Making the instrumental section of the song)</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Editing" value="Editing" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Editing">Editing</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Vocal Tuning" value="Vocal Tuning" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Vocal Tuning">Vocal Tuning</label>
                            </li>
                            <li>
                                <input type="checkbox" name="Other" value="Other" required="" aria-required="true">
                                <label class="contact-form__label contact-form__label--checkbox" for="Other">Other</label>
                            </li>
                        </ul>
                    </div>
                    <div data-field-id="6">
                        <label class="contact-form__label" for="Desired Project Start/End Date">Desired Project Start/End Date</label>
                        <input class="contact-form__field" type="text" name="Desired Project Start/End Date">
                    </div>
                    <div data-field-id="7">
                        <label class="contact-form__label" for="Budget">Budget <span class="contact-form__required-indicator">*</span></label>
                        <input class="contact-form__field" type="text" name="Budget" required="" aria-required="true">
                    </div>
                    <div data-field-id="8">
                        <label class="contact-form__label" for="Number of Songs">Number of Songs</label>
                        <input class="contact-form__field" type="text" name="Number of Songs">
                    </div>
                    <div data-field-id="2">
                        <label class="contact-form__label" for="Project Details/Link to Demos or Artist Website">Project Details/Link to Demos or Artist Website</label>
                        <textarea class="contact-form__field contact-form__field--big contact-form__field--project-details" name="Project Details/Link to Demos or Artist Website"></textarea>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="_next" value="<?php echo get_site_url('/form-submission-successful'); ?>">
<!--                     <input type="hidden" name="wpforms[id]" value="5">
                    <input type="hidden" name="wpforms[author]" value="0"> -->
                    <button class="nav-reg__button nav-reg__button--contact" type="submit" name="Submit Quote Request" value="submit-quote-request" data-alt-text="Sending...">Submit Quote Request</button>
                </div>
            </form>
    </div>
<!--     <div class="well__title well__medium-width">
        <?php 
    echo do_shortcode(get_post(6)->post_content);
    ?>
    </div> -->
</section>
<?php
  get_footer();
?>