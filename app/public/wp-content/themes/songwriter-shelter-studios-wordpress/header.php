<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1" />
    <meta charset="<?php bloginfo(" charset "); ?>"/>
    <!-- <title>The Songwriter Shelter Recording Studios | Max Garceau</title> -->
    <!-- <meta name="generator" content="Wix.com Website Builder"> -->
    <meta name="fb_admins_meta_tag" content="" />
    <meta name="keywords" content="Arranging, Audio, Engineer, Mastering, Metal, Mixing, Music, Recording, Rock, Studio" />
    <meta name="description" content="The Songwriter Shelter Recording Studios is a music writing, recording and production company based out of Nashville, TN. Contact Max Garceau today for a quote." />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png" type="image/png" />
    
<!--     <meta http-equiv="X-Wix-Meta-Site-Id" content="3d58b758-817c-4ab8-ae6f-cb7853448b13" />
    <meta http-equiv="X-Wix-Application-Instance-Id" content="c4d8f195-dd27-4ac6-989b-898635bdea80" />
    <meta http-equiv="X-Wix-Published-Version" content="141" /> -->

    <meta http-equiv="etag" content="dcc504720ff6a9ebac1ef56d5ea7cb7e" />
    <meta property="og:title" content="The Songwriter Shelter Recording Studios | Max Garceau" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.songwritershelterstudios.com/" />
    <meta property="og:image" content="https://static.wixstatic.com/media/6a1d9d_f59dc084a5804bdc9a3f64c2fa420bc5%7Emv2.png" />
    <meta property="og:site_name" content="The Songwriter Shelter Recording Studios | Max Garceau" />
    <meta property="og:description" content="The Songwriter Shelter Recording Studios is a music writing, recording and production company based out of Nashville, TN. Contact Max Garceau today for a quote." />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="5DyTKsh-rTSExWv4G9KAXtvSCmLhz-emDp1X1YKoQXY" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-bg-color fixed-top" id="mainNav">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav m-auto">
                        <!-- Production Studio Website Menu -->
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#home') ?>">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#services') ?>">SERVICES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#my-work') ?>">MY WORK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#testimonials') ?>">TESTIMONIALS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#about') ?>">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo site_url('#request-a-quote') ?>">REQUEST A QUOTE</a>
                        </li>
                        <!-- Navigation for Blogs -->
                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger btndown" href="<?php echo site_url('/songwriter-shelter-studios-blog-pages') ?>">BLOGS<span class="fa fa-angle-down"></span></a>
                            <ul class="itemdown">
                                <li>
                                    <a class="nav-link js-scroll-trigger" href="<?php echo site_url('/songwriter-shelter-studios-blog-pages/songwriter-salon-music-philosophy-in-the-21st-century') ?>">Songwriter Salon</a>
                                </li>
                                <li>
                                    <a class="nav-link js-scroll-trigger" href="<?php echo site_url('/songwriter-shelter-studios-blog-pages/songwriter-advice-from-a-nashville-music-producer') ?>">Advice For Songwriters</a>
                                </li>
                                <li>
                                    <a class="nav-link js-scroll-trigger" href="<?php echo site_url('/songwriter-shelter-studios-blog-pages/modern-music-production-and-composition-a-deep-dive-into-the-why-and-the-how') ?>">Music Tutorials</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Navigation for Forum -->
                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger btndown" href="<?php echo site_url('/songwriter-shelter-forum') ?>">FORUM</a>
                        </li>
                        <!-- Live Search -->
                        <li class="nav-item">
                            <a href="<?php echo esc_url(site_url('/search')); ?>" class="nav-link js-search-trigger"><span class="fa fa-search" aria-hidden="true"></span></a>
                        </li>
                    </ul>
                    <!-- User Name Display -->
                    <?php userRegNameDisplay(); ?>
                    <!-- User Registration/Login Button -->
                    <?php userRegButton(); ?>
                </div>
            </div>
        </nav>
    </header>